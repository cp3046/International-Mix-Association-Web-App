<form action="<?php echo esc_url( $current_url ); ?>" method="post" autocomplete="off" class="nd_form nd_lost_password_form" style="display:none"><div class="nd_form_inner">

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

	<p><?php _e('Please enter your username or e-mail address. You will receive a new password via e-mail.', 'ninety'); ?></p>

	<p><label for="nd_lost_username"><?php _e('Username/Email','ninety'); ?>:</label> <input type="text" class="text" name="username_or_email" id="nd_lost_username" placeholder="<?php _e('you@yourdomain.com', 'ninety'); ?>" /></p>

	<p><input type="submit" class="button" value="<?php _e('Send Password &rarr;','ninety'); ?>" /><input name="nd_lostpass" type="hidden" value="true"  /></p>

</div></form>