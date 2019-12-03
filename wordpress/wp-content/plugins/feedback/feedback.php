<?php
/**
 * @package Feedback
 * /**
 * Plugin Name: Feedback
 * Description: Test plugin
 * Version: 1.0
 * Author: Itransition
 **/

define( 'FEEDBACK__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
require_once( FEEDBACK__PLUGIN_DIR . 'class.feedback-admin.php' );

register_activation_hook( __FILE__, array( 'Feedback_Admin', 'feedbacks_install' ));

add_action( 'init', array( 'Feedback_Admin', 'init' ) );

