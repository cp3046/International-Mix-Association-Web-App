Our Sidebar Login/Register plugin for WordPress does exactly what it says on the tin; Logins and Registrations with a touch of Ajax magic. Simple! It also has a nice 'logged in' view, and a lost password form for those forgetful folk.

Its simple to get started - in most cases just activate the plugin, add the widget to your sidebar and go!

== Features ==

*	A login and registration widget for your blog
*	Tabs/links for logged out users include login, register, and 'lost password'.
*	Logged in users can see their name, avatar, last logged in date, recent activity, and comments/posts since last sign in.
*	AJAX validation makes this thing run smooooth
*	Callable from a function in case you hate widgets

== Installation ==

*	Upload the ninety-login plugin folder to your wp-content/plugins/ directory.
*	Activate the plugin from the WordPress admin panel
*	Your ready! In the WP admin panel go to the Appearance > Widgets section and drag this bad-boy into your sidebar.
*	NOTE: there are no widget options so don't be alarmed :)

== Usage, As a function instead of a widget ==

Add the function nd_login_widget( $args ); to your theme. $args is optional and can can take an array of options (before_title, after_title, before_widget, after_widget).

== Usage, As a shortcode ==

Use the [nd_login] shortcode.

== Styling ==

You may want to style the widget to make it match your theme; to do so you have three options.

	1) Edit css/login.css in the plugin (be sure to back this up if you ever update the plugin).
	2) Make a folder inside your theme called 'ninety-login' and add the login.css file there. The plugin will call this stylesheet instead of its own.
	3) Just add extra styles to your theme css

== Customisation (advanced) ==

So you want to customise the templates/tabs or add new ones?

Make a folder inside your theme called 'ninety-login' and add the template files from the plugin:

	- logged-in.php,
	- login-form.php,
	- lost-password-form.php,
	- register-form.php,
	- tabs.php

Then edit away; the plugin will give priority to these files. This will let you add custom text, CAPTCHA or anything to the widget.

== Widget not working? ==

Most *good* themes contain the required wp_head/wp_footer hooks - if yours does not you will need to slap your developer on the back of the head and add them to your theme's header and footer.php files.

http://codex.wordpress.org/Plugin_API/Action_Reference/wp_head
http://codex.wordpress.org/Plugin_API/Action_Reference/wp_footer

Basically, add: <?php wp_head(); ?> in header.php and <?php wp_footer(); ?> in footer.php.

== Additonal Notes / Support ==

If you find a bug with this plugin please give us full details in the comments section on CodeCanyon. From here we will assist.

However, we will *not* assist with styling and customisation issues - this is beyond the scope of support and should be performed by a developer/designer.

Thanks :)

== Change Log ==

= 1.1.3 - 09.08.2013 =
* Update blockui

= 1.1.2 - 17.03.2013 =
* Return widget - don't echo

= 1.1.0 - 07.12.2012 =
* Full rewrite.
* Fixed a few markup bugs.
* Cleaned up the templates.
* Drag and drop FAQ ordering instead of input box based ordering.
* Use via a shortcode.
* Support multiple forms per page

= 1.0.1 - 09.02.2011 =
* Potential date bug fixed