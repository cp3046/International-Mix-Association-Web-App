<?php
if ( ! class_exists( 'Ninety_Base' ) ) {
	/**
	 * Ninety_Base class.
	 */
	class Ninety_Base {

		/** @var array */
		var $settings;

		/** @var string */
		var $plugin_id;

		/** @var string */
		var $file;

		/** @var string */
		var $plugin_url;

		/** @var string */
		var $plugin_path;

		function init_settings() {}

		/**
		 * install function.
		 *
		 * @access public
		 * @return void
		 */
		function install() {
			$this->init_settings();

			if ( ! empty( $this->settings ) ) {
				foreach( $this->settings as $section ) {
					foreach( $section[1] as $option ) {
						add_option( $option[0], $option[1] );
					}
				}
			}
		}

		/**
		 * plugin_url function.
		 *
		 * @access public
		 * @return void
		 */
		function plugin_url() {
			if ( $this->plugin_url )
				return $this->plugin_url;

			return $this->plugin_url = plugins_url( basename( plugin_dir_path( $this->file ) ), basename( $this->file ) );
		}

		/**
		 * plugin_path function.
		 *
		 * @access public
		 * @return void
		 */
		function plugin_path() {
			if ( $this->plugin_path )
				return $this->plugin_path;

			return $this->plugin_path = untrailingslashit( plugin_dir_path( $this->file ) );
		}

		/**
		 * locate_template function.
		 *
		 * @access public
		 * @param mixed $template_name
		 * @return void
		 */
		function locate_template( $template_name ) {

			$template_path = trailingslashit( $this->plugin_id );
			$default_path  = $this->plugin_path() . '/templates/';

			// Allow theme to override templates
			$template = locate_template(
				array(
					$template_path . $template_name
				)
			);

			// Get default template
			if ( ! $template )
				$template = $default_path . $template_name;

			return $template;
		}

		/**
		 * get_template function.
		 *
		 * @access public
		 * @param mixed $template_name
		 * @param array $args (default: array())
		 * @return void
		 */
		function get_template( $template_name, $args = array() ) {

			$located = $this->locate_template( $template_name );

			if ( $args && is_array( $args ) )
				extract( $args );

			include( $located );
		}
	}
}