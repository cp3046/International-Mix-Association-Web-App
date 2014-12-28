<form action="<?php echo esc_url( $current_url ); ?>" method="post" class="nd_form nd_login_form"><div class="nd_form_inner">

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

	<p><label for="nd_username"><?php _e('Username','ninety'); ?>:</label> <input type="text" class="text" name="log" id="nd_username" placeholder="<?php _e('Username', 'ninety'); ?>" /></p>
	<p><label for="nd_password"><?php _e('Password','ninety'); ?>:</label> <input type="password" class="text" name="pwd" id="nd_password" placeholder="<?php _e('Password','ninety'); ?>" /></p>
	<p>
		<a class="forgotten" href="#nd_lost_password_form"><?php _e('Can\'t login?','ninety'); ?></a> <input type="submit" class="button" value="<?php _e('Login &rarr;','ninety'); ?>" />
		<input name="nd_login" type="hidden" value="true"  />
		<input name="rememberme" type="hidden" id="rememberme" value="forever"  />
		<input name="redirect_to" type="hidden" id="redirect_to" value="<?php echo esc_url( $current_url ); ?>"  />
	</p>
</div></form>