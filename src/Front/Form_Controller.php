<?php
namespace Formacopoeia\Front;

use \Formacopoeia\All\Form_Controller as Form;
use \Formacopoeia\All\Property_Controller;

class Form_Controller extends \WP_Plugin_Maker\Controller {

    public static $inited = false;

    public static function init() {
        self::$inited = true;
        wp_enqueue_script('fc-core', WP_PLUGIN_URL . '/formacopoeia/assets/front/core.js', ['light-query']);
        $properties = Property_Controller::get_all();
    }

    public static function render_form_slot(Form $form) {
        return '<div data-formacopoeia-slot="' . $form->ID . '"></div>';
    }

}

