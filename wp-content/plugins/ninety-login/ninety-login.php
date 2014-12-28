<?php
/*
Plugin Name: Ninety Ajax Login/Register
Plugin URI: http://codecanyon.net/item/ninety-ajax-loginregister-for-wordpress/158711
Description: Easily add a login/register widget to your WordPress blog's sidebar.
Version: 1.1.3
Author: Ninety Degrees
Author URI: http://codecanyon.net/user/ninetydegrees
*/

if ( ! class_exists( 'Ninety_Base' ) )
	include_once( 'classes/class-ninety-base.php' );

/**
 * Ninety_Login class.
 *
 * @extends Ninety_Base
 */
class Ninety_Login extends Ninety_Base {

	var $login_errors;
	var $reg_errors;
	var $lost_pass_errors;

	/**
	 * __construct function.
	 *
	 * @access public
	 * @return void
	 */
	function __construct() {

		$this->plugin_id = 'ninety-login';
		$this->file      = __FILE__;

		// Localise
		load_plugin_textdomain( 'ninety-login', false, dirname( plugin_basename( __FILE__ ) ).'/languages' );

		if ( ! is_admin() ) {
			add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
			add_action( 'init', array( $this, 'styles' ) );
			add_action( 'wp_head', array( $this, 'update_user_view_meta' ) );
		}

		add_action( 'widgets_init', array( $this, 'register_widget' ) );
		add_action('init', array( $this, 'process_login_form' ) );
	}

	/**
	 * scripts function.
	 *
	 * @access public
	 * @return void
	 */
	function scripts() {
		wp_register_script( 'blockui', $this->plugin_url() . '/js/blockui.js' , 'jquery', '1.1.3', true );
		wp_enqueue_script( 'ajax_login_js', $this->plugin_url() . '/js/login.js' , array( 'jquery', 'blockui' ), '1.1.0', true );
	}

	/**
	 * styles function.
	 *
	 * @access public
	 * @return void
	 */
	function styles() {
		$logincss = $this->plugin_url() . '/css/login.css';

		if ( file_exists( TEMPLATEPATH . '/ninety-login/login.css' ) )
			$logincss = get_bloginfo('template_url') . '/ninety-login/login.css';

		if ( is_ssl() )
			$logincss = str_replace( 'http://','https://', $logincss );

		wp_enqueue_style( 'login_css', $logincss );
	}

	/**
	 * update_user_view_meta function.
	 *
	 * @access public
	 * @return void
	 */
	function update_user_view_meta() {

		if ( is_user_logged_in() && is_single() ) {
			global $post;

			$user_id = get_current_user_id();
			$posts = get_user_meta( $user_id, 'nd_viewed_posts', true );

			if ( ! is_array( $posts ) )
				$posts = array();

			if ( sizeof( $posts ) > 4 )
				array_shift( $posts );

			if ( ! in_array( $post->ID, $posts ) )
				$posts[] = $post->ID;

			update_user_meta( $user_id, 'nd_viewed_posts', $posts );
		}
	}

	/**
	 * update_user_meta function.
	 *
	 * @access public
	 * @param mixed $user_id
	 * @return void
	 */
	function update_user_meta( $user_id ) {
		update_user_meta( $user_id, 'nd_login_time', current_time('timestamp') );
		update_user_meta( $user_id, 'nd_num_comments', wp_count_comments()->approved );
		update_user_meta( $user_id, 'nd_num_posts', wp_count_posts('post')->publish );
	}

	/**
	 * register_widget function.
	 *
	 * @access public
	 * @return void
	 */
	function register_widget() {
		include_once( 'classes/class-ninety-login-widget.php' );

		register_widget( 'Ninety_Login_widget' );
	}

	function current_url() {
		$pageURL = 'http://';
		$pageURL .= $_SERVER['HTTP_HOST'];
		$pageURL .= $_SERVER['REQUEST_URI'];
		if ( force_ssl_login() || force_ssl_admin() ) $pageURL = str_replace( 'http://', 'https://', $pageURL );
		return $pageURL;
	}

	/**
	 * widget function.
	 *
	 * @access public
	 * @return void
	 */
	function widget( $args ) {
		extract( $args );

		echo $before_widget . '<div class="nd_login_widget">';

		if ( is_user_logged_in() ) {

			$this->get_template( 'tabs.php', array(
				'current_user' => wp_get_current_user()
			) );

			$this->get_template( 'logged-in.php', array(
				'current_user' => wp_get_current_user(),
				'current_url'  => $this->current_url(),
				'before_title' => $before_title,
				'after_title'  => $after_title,
			) );

		} else {

			$this->get_template( 'tabs.php', array(
				'current_user' => wp_get_current_user()
			) );

			$this->get_template( 'login-form.php', array(
				'current_url' => $this->current_url(),
				'before_title' => $before_title,
				'after_title'  => $after_title,
			) );

			if ( get_option( 'users_can_register' ) )
				$this->get_template( 'register-form.php', array(
					'current_url' => $this->current_url(),
					'errors' => $this->reg_errors,
					'before_title' => $before_title,
				'after_title'  => $after_title,
				) );

			$this->get_template( 'lost-password-form.php', array(
				'current_url' => $this->current_url(),
				'before_title' => $before_title,
				'after_title'  => $after_title,
			) );
		}
		echo '</div>' . $after_widget;
	}

	/**
	 * process_login_form function.
	 *
	 * @access public
	 * @return void
	 */
	function process_login_form() {
		if ( ! empty( $_POST['nd_login'] ) )
			$this->login_errors = $this->login();
		elseif ( get_option( 'users_can_register' ) && ! empty( $_POST['nd_register'] ) )
			$this->reg_errors = $this->register();
		elseif ( ! empty( $_POST['nd_lostpass'] ) )
			$this->lost_pass_errors = $this->lost_password();
	}

	/**
	 * login function.
	 *
	 * @access public
	 * @return void
	 */
	function login() {

		$redirect_to = isset( $_REQUEST['redirect_to'] ) ? $_REQUEST['redirect_to'] : admin_url();
		$secure_cookie = ( is_ssl() && force_ssl_login() && ! force_ssl_admin() && ( 0 !== strpos( $redirect_to, 'https' ) ) && ( 0 === strpos($redirect_to, 'http') ) ) ? false : '';
		$user = wp_signon( '', $secure_cookie );

		// Check the username
		if ( empty( $_POST['log'] ) ) {
			$user = new WP_Error();
			$user->add( 'empty_username', __('<strong>ERROR</strong>: Please enter a username.', 'ninety-login' ) );
		} elseif ( empty( $_POST['pwd'] ) ) {
			$user = new WP_Error();
			$user->add( 'empty_username', __('<strong>ERROR</strong>: Please enter your password.', 'ninety-login' ) );
		}

		$redirect_to = apply_filters( 'nd_login_redirect', apply_filters( 'login_redirect', $redirect_to, $redirect_to, $user ) );

		if ( ! is_wp_error( $user ) )
			$this->update_user_meta( $user->ID );

		if ( is_ajax() ) {
			if ( ! is_wp_error( $user ) )
				echo 'SUCCESS';
			else
				foreach ( $user->errors as $error ) {
					echo str_replace( array( 'Lost your password?' ), '', strip_tags( $error[0] ) );
					break;
				}
			exit;
		} else {
			if ( ! is_wp_error( $user ) ) :
				wp_redirect( esc_url( $redirect_to ) );
				exit;
			endif;
		}
		return $user;
	}

	/**
	 * register function.
	 *
	 * @access public
	 * @return void
	 */
	function register() {

		$errors               = new WP_Error();

		$user_login           = sanitize_user( $_POST['username'], true );
		$user_email           = apply_filters( 'user_registration_email', isset( $_POST['email'] ) ? sanitize_text_field( $_POST['email'] ) : '' );
		$password             = isset( $_POST['password'] ) ? sanitize_text_field( $_POST['password'] ) : '';
		$password2            = isset( $_POST['password2'] ) ? sanitize_text_field( $_POST['password2'] ) : '';

		// Check the username
		if ( $_POST['username'] == '' )
			$errors->add('empty_username', __('<strong>ERROR</strong>: Please enter a username.', 'ninety-login'));
		elseif ( ! validate_username( $_POST['username'] ) )
			$errors->add('invalid_username', __('<strong>ERROR</strong>: This username is invalid.  Please enter a valid username.', 'ninety-login'));
		elseif ( username_exists( $user_login ) )
			$errors->add('username_exists', __('<strong>ERROR</strong>: This username is already registered, please choose another one.', 'ninety-login'));

		// Check the e-mail address
		if ( $user_email == '' )
			$errors->add('empty_email', __('<strong>ERROR</strong>: Please type your e-mail address.', 'ninety-login'));
		elseif ( ! is_email( $user_email ) )
			$errors->add('invalid_email', __('<strong>ERROR</strong>: The email address isn&#8217;t correct.', 'ninety-login'));
		elseif ( email_exists( $user_email ) )
			$errors->add('email_exists', __('<strong>ERROR</strong>: This email is already registered, please choose another one.', 'ninety-login'));

		// Check Passwords match
		if ( $password == '')
			$errors->add('empty_password', __('<strong>ERROR</strong>: Please enter a password.', 'ninety-login'));
		elseif ( $password !== $password2 )
			$errors->add('wrong_password', __('<strong>ERROR</strong>: Passwords do not match.', 'ninety-login'));
		else
			$user_pass = $password;

		do_action( 'register_post', $user_login, $user_email, $errors );

		$errors = apply_filters( 'registration_errors', $errors, $user_login, $user_email );

		if ( ! $errors->get_error_code() ) {

			$user_id = wp_create_user( $user_login, $user_pass, $user_email );
			if ( ! $user_id ) {
				$errors->add( 'registerfail', sprintf(__('<strong>ERROR</strong>: Couldn&#8217;t register you... please contact the <a href="mailto:%s">webmaster</a> !', 'ninety-login'), get_option('admin_email') ) );
			} else {
				$secure_cookie = is_ssl() ? true : false;
			    wp_set_auth_cookie( $user_id, true, $secure_cookie );
			    wp_new_user_notification( $user_id, $user_pass );
			    $this->update_user_meta( $user_id );
			}
		}

	    if ( is_ajax() ) {
			if ( ! $errors->get_error_code() ) :
				echo 'SUCCESS';
			else :
				foreach ( $errors->errors as $error ) {
					echo $error[0];
					break;
				}
			endif;
			exit;
		} else {
			if ( ! is_wp_error($user) ) {
			    wp_redirect( $this->current_url() );
			    exit;
			}
		}
		return $errors;
	}

	/**
	 * lost_password function.
	 *
	 * @access public
	 * @return void
	 */
	function lost_password() {

		global $wpdb, $current_site;

		$errors = new WP_Error();

		if ( empty( $_POST['username_or_email'] ) )
			$errors->add('empty_username', __('<strong>ERROR</strong>: Enter a username or e-mail address.', 'ninety-login'));

		if ( strpos( $_POST['username_or_email'], '@' ) ) {
			$user_data = get_user_by( 'email', sanitize_text_field( $_POST['username_or_email'] ) );
			if ( empty($user_data) )
				$errors->add('invalid_email', __('<strong>ERROR</strong>: There is no user registered with that email address.', 'ninety-login'));
		} else {
			$login = sanitize_text_field( $_POST['username_or_email'] );
			$user_data = get_user_by( 'login', $login );
		}

		do_action( 'lostpassword_post' );

		if ( !$user_data )
			$errors->add('invalidcombo', __('<strong>ERROR</strong>: Invalid username or e-mail.', 'ninety-login'));

		if (is_ajax()) :
			if ( $errors->get_error_code() ) :
				foreach ($errors->errors as $error) {
					echo $error[0];
					break;
				}
				exit;
			endif;
		else :
			if ( $errors->get_error_code() ) return $errors;
		endif;

		$user_login = $user_data->user_login;
		$user_email = $user_data->user_email;

		do_action('retrieve_password', $user_login);

		$allow = apply_filters('allow_password_reset', true, $user_data->ID);

		if ( !$allow ) $errors->add('no_password_reset', __('Password reset is not allowed for this user', 'ninety-login'));
		else if ( is_wp_error($allow) ) $errors = $allow;

		if (is_ajax()) :
			if ( $errors->get_error_code() ) :
				foreach ($errors->errors as $error) {
					echo $error[0];
					break;
				}
				exit;
			endif;
		else :
			if ( $errors->get_error_code() ) return $errors;
		endif;

		$key = $wpdb->get_var($wpdb->prepare("SELECT user_activation_key FROM $wpdb->users WHERE user_login = %s", $user_login));
		if ( empty($key) ) {
			// Generate something random for a key...
			$key = wp_generate_password(20, false);
			do_action('retrieve_password_key', $user_login, $key);
			// Now insert the new md5 key into the db
			$wpdb->update($wpdb->users, array('user_activation_key' => $key), array('user_login' => $user_login));
		}
		$message = __('Someone has asked to reset the password for the following site and username.', 'ninety-login') . "\r\n\r\n";
		$message .= network_site_url() . "\r\n\r\n";
		$message .= sprintf(__('Username: %s', 'ninety-login'), $user_login) . "\r\n\r\n";
		$message .= __('To reset your password visit the following address, otherwise just ignore this email and nothing will happen.', 'ninety-login') . "\r\n\r\n";
		$message .= network_site_url("wp-login.php?action=rp&key=$key&login=" . rawurlencode($user_login), 'login') . "\r\n";

		if ( is_multisite() ) $blogname = $GLOBALS['current_site']->site_name;
		else $blogname = wp_specialchars_decode(get_option('blogname'), ENT_QUOTES);

		$title = sprintf( __('[%s] Password Reset', 'ninety-login'), $blogname );

		$title = apply_filters('retrieve_password_title', $title);
		$message = apply_filters('retrieve_password_message', $message, $key);

		wp_mail($user_email, $title, $message);

		if (is_ajax()) :
			echo 'SUCCESS:'.__('Check your e-mail for the confirmation link.', 'ninety-login');
			exit;
		endif;

		return true;
	}
}

$GLOBALS['Ninety_Login'] = new Ninety_Login();

/**
 * is_ajax - Returns true when the page is loaded via ajax.
 *
 * @access public
 * @return bool
 */
if ( ! function_exists( 'is_ajax' ) ) {
	function is_ajax() {
		if ( defined('DOING_AJAX') )
			return true;

		return ( isset( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) ? true : false;
	}
}

/**
 * Lets you call the widget directly from code.
 *
 * @access public
 * @param mixed $args
 * @return void
 */
function nd_login_widget( $args ) {

	$defaults = array(
		'before_widget' => '',
		'after_widget' => '',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	);

	$args = wp_parse_args( $args, $defaults );

	ob_start();

	$GLOBALS['Ninety_Login']->widget( $args );

	return ob_get_clean();
}

add_shortcode( 'nd_login', 'nd_login_widget' );