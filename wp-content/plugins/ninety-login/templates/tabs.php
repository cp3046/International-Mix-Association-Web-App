<?php if ( is_user_logged_in() ) : ?>

	<ul class="nd_tabs">
		<li class="active"><a href="#nd_user"><?php echo $current_user->user_login; ?></a></li>
		<li><a href="#nd_recently_viewed"><?php _e('Activity', 'ninety-login'); ?></a></li>
	</ul>

<?php else : ?>

	<ul class="nd_tabs">
		<li class="active"><a href="#nd_login_form"><?php _e('Login', 'ninety-login'); ?></a></li>
		<?php if ( get_option('users_can_register') ) : ?>
			<li><a href="#nd_register_form"><?php _e('Register', 'ninety-login'); ?></a></li>
		<?php endif; ?>
	</ul>

<?php endif; ?>