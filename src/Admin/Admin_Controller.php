<?php
namespace Formacopoeia\Admin;

use \Formacopoeia\All\Template2_Controller;
use \Formacopoeia\All\Translate_Controller;
use \Formacopoeia\All\Main_Controller;

class Admin_Controller extends \WP_Plugin_Maker\Controller {

    public static function action_init() {
        Translate_Controller::init();
        Template2_Controller::init();
        Main_Controller::enqueue_scripts();

        wp_enqueue_script('fc-renderer', WP_PLUGIN_URL . '/formacopoeia/assets/both/renderer.js');
        add_thickbox();
    }

    // Admin enqueue script filter to add

    public static function add_menu_page($options) {
        call_user_func_array('add_menu_page', self::resolve_args($options));
    }

    private static function resolve_args($options) {
        extract($options);
        
        return [
            $page_title ?: $menu_title, 
            $menu_title, 
            'manage_options' ?: $capability, 
            $menu_slug ?: sanitize_title($menu_title), 
            function() use ($callable) {
                static::$callable();
            }, 
            $icon_url ?: '', 
            $position ?: null
        ];
    }

    public static function add_submenu_page($options) {
        $args = self::resolve_args($options);
        array_unshift($args, $options['parent_slug']);
        call_user_func_array('add_submenu_page', $args);
    }
}