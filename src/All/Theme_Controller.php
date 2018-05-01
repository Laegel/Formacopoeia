<?php
namespace Formacopoeia\All;

class Theme_Controller extends Registerable_Controller {

    protected static $inited = false;
    protected static $items = [];
    
    protected static function init() {
        self::$items[] = [
            'name' => 'dark',
            'options' => [
                'label' => 'Dark',
                'path' => WP_PLUGIN_URL . '/formacopoeia/assets/front/themes/dark.css'
            ]
        ];
        self::$inited = true;
    }

}

