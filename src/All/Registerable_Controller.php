<?php
namespace Formacopoeia\All;

abstract class Registerable_Controller extends \WP_Plugin_Maker\Controller {

    protected static $inited = false;
    protected static $items = [];

    protected static function init() {
        $caller = get_called_class();
        $caller::$inited = true;
    }

    public static function register($name, $options) {
        $caller = get_called_class();
        $caller::$items[] = compact('name', 'options');
    }

    public static function get_all() {
        $caller = get_called_class();
        if (!$caller::$inited) {
            $caller::init();
        }
        return $caller::$items;
    }
}

