<?php

/**
 * Ninety_Login_widget class.
 *
 * @extends WP_Widget
 */
class Ninety_Login_widget extends WP_Widget {

    /**
     * Ninety_Login_widget function.
     *
     * @access public
     * @return void
     */
    function Ninety_Login_widget() {
        $widget_ops = array(
        	'description' => __( 'An Ajax powered Login &amp; Register widget. See the ReadMe for customisation instructions.', 'ninety-login' )
        );

		$this->WP_Widget( 'ninety_login_widget', __('Ninety Ajax Login/Register', 'ninety-login'), $widget_ops );
    }

    /**
     * widget function.
     *
     * @access public
     * @param mixed $args
     * @param mixed $instance
     * @return void
     */
    function widget( $args, $instance ) {
        $GLOBALS['Ninety_Login']->widget( $args );
    }
}