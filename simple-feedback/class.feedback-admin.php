<?php
declare(strict_types=1);

class Feedback_Admin
{
    private static $initiated = false;

    public static function init()
    {
        if (!self::$initiated) {
            self::init_hooks();
        }
    }

    private static function init_hooks()
    {
        self::$initiated = true;
        add_action('admin_menu',  array( 'Feedback_Admin',  'register_feedback_admin_menus' ), 1);
        add_shortcode( 'feedback-form', array(  'Feedback_Admin', 'feedback_form' ) );
    }

    public function feedback_form()
    {
        ob_start();
        require_once( plugin_dir_path( __FILE__ )."templates/contact-form.php" );
        return ob_get_clean();
    }

    function register_feedback_admin_menus()
    {
        add_menu_page(
            'Feedback Plugin',
            'Feedbacks',
            'manage_options',
            'feedback_admin_show_feedbacks',
            array( 'Feedback_Admin',  'feedback_index'),
            '',
            120
        );
        add_submenu_page(
            'feedback_admin_show_feedbacks',
            'Manage Subjects',
            'Manage Subjects',
            'manage_options',
            'feedback_admin_subjects',
            array( 'Feedback_Admin',  'feedback_subjects')

        );
    }

    public function feedback_index()
    {
        load_template(plugin_dir_path( __FILE__ ).'/templates/admin_index.php');
    }

    public function feedback_subjects()
    {
        load_template(plugin_dir_path( __FILE__ ).'/templates/admin_subjects.php');
    }

    function feedbacks_install()
    {
        global $wpdb;
        $table_name_feedbacks = $wpdb->prefix . 'feedbacks';
        $table_name_subjects = $wpdb->prefix . 'subjects';

        $charset_collate = $wpdb->get_charset_collate();

        $sql = "CREATE TABLE $table_name_feedbacks (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		name tinytext NOT NULL,
		email varchar(55) NOT NULL,
		subject text NOT NULL,
		text text NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";
        $sql = $sql . "CREATE TABLE $table_name_subjects (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		subject text NOT NULL,
		email varchar(55) NOT NULL,
		PRIMARY KEY  (id)
	) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
}
