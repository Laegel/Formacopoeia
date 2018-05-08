<?php
namespace Formacopoeia\Front;

use \Formacopoeia\All\Form_Controller as Form;
use \Formacopoeia\Configurable\Property;

class Form_Controller extends \WP_Plugin_Maker\Controller {

    public static $inited = false;

    public static function init() {
        self::$inited = true;
        wp_enqueue_script('fc-core-front', WP_PLUGIN_URL . '/formacopoeia/assets/front/core.js', ['fc-light-query']);
        $properties = Property::get_all();
    }

    public static function render_form_slot(Form $form) {
        $transient = 'formacopoeia_' . md5(uniqid($form->ID));
        set_transient($transient, $form->ID, HOURS_IN_SECONDS);
        return '<form action="" data-token="' . $transient . '" data-formacopoeia-slot="' . $form->ID . '"><div class="fc-meta"><input type="hidden" name="nonce" value="' . wp_create_nonce('formacopoeia_form_' . $form->ID) . '"></div><div class="fc-wrapper"></div></form>';
    }

}

