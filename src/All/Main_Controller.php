<?php
namespace Formacopoeia\All;

use Formacopoeia\Plugin;
use Formacopoeia\Front\Form_Controller as Front_Form;

class Main_Controller extends \WP_Plugin_Maker\Controller {

    public static function enqueue_scripts() {
        wp_enqueue_script('fc-qwest', Plugin::$url . '/assets/libs/qwest.min.js');
        wp_enqueue_script('fc-utils', Plugin::$url . '/assets/libs/utils.js');
        wp_enqueue_script('fc-handlebars', Plugin::$url . '/assets/libs/handlebars.min-latest.js', ['fc-utils']);
        wp_enqueue_script('fc-handlebars-helpers', Plugin::$url . '/assets/libs/handlebars-helpers.js', ['fc-handlebars']);
    }

    public static function action_init() {
        add_shortcode('formacopoeia', self::class . '::register_shortcode');
    }

    public static function register_shortcode($attributes) {
        if (!Front_Form::$inited) {
            self::enqueue_scripts();
            Front_Form::init();
        }

        if (isset($attributes['id'])) {
            $form = Form_Controller::get_by_id($attributes['id']);
            $fields = $form->get_fields();
        }
        if (!isset($form->ID)) {
            return;
        }
        
        return Front_Form::render_form_slot($form);
    }
}

