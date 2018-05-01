<?php
namespace Formacopoeia\All;

use Formacopoeia\Front\Form_Controller as Front_Form;

class Main_Controller extends \WP_Plugin_Maker\Controller {

    public static function enqueue_scripts() {
        wp_enqueue_script('light-query', WP_PLUGIN_URL . '/formacopoeia/assets/libs/light-query.js');
        wp_enqueue_script('handlebars', WP_PLUGIN_URL . '/formacopoeia/assets/libs/handlebars.min-latest.js');
        wp_enqueue_script('handlebars-helpers', WP_PLUGIN_URL . '/formacopoeia/assets/libs/handlebars-helpers.js', ['handlebars']);
        wp_enqueue_script('formacopoeia-renderer', WP_PLUGIN_URL . '/formacopoeia/assets/both/renderer.js');
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
        
        return Front_Form::render_form_slot($form);
    }
}
