<form action="<?php echo esc_url( $current_url ); ?>" method="post" autocomplete="off" class="nd_form nd_register_form" style="display:none"><div class="nd_form_inner">

	<!-- Show Errors -->
	<?php
		if ( ! empty( $errors ) && $errors->get_error_code() ) {
			echo '<ul class="errors">';
			foreach ( $errors->errors as $error ) {
				echo '<li>' . esc_html( $error[0] ) . '</li>';
				break;
			}
			echo '</ul>';
		}
	?>

	<p><label for="nd_reg_username"><?php _e('Username','ninety-login'); ?>:</label> <input type="text" class="text" name="username" id="nd_reg_username" placeholder="<?php _e('Username', 'ninety-login'); ?>" /></p>

	<p><label for="nd_reg_email"><?php _e('Email','ninety-login'); ?>:</label> <input type="text" class="text" name="email" id="nd_reg_email" placeholder="<?php _e('you@yourdomain.com', 'ninety-login'); ?>" /></p>

	<p class="column"><label for="nd_reg_password"><?php _e('Password','ninety-login'); ?>:</label> <input type="password" class="text" name="password" id="nd_reg_password" placeholder="<?php _e('Password','ninety-login'); ?>" /></p>

	<p class="column column-alt"><label for="nd_reg_password_2" class="hidden"><?php _e('Re-enter','ninety-login'); ?>:</label> <input type="password" class="text" name="password2" id="nd_reg_password_2" placeholder="<?php _e('Re-enter','ninety-login'); ?>" /></p>

	<?php do_action( 'register_form' ); ?>

	<p><input type="submit" class="button" value="<?php _e('Register &rarr;','ninety-login'); ?>" /><input name="nd_register" type="hidden" value="true"  /></p>

</div></form>