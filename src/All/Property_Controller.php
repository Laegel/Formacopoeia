<?php
namespace Formacopoeia\All;

class Property_Controller extends Registerable_Controller {

    protected static $inited = false;
    protected static $items = [];

    protected static function init() {
        $path = \Formacopoeia\Plugin::$dir . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'properties' . DIRECTORY_SEPARATOR;
        array_unshift(self::$items, [
            'name' => 'text',
            'options' => $path . 'text.html'
        ], [
            'name' => 'textarea',
            'options' => $path . 'textarea.html'
        ], [
            'name' => 'checkbox',
            'options' => $path . 'checkbox.html'
        ], [
            'name' => 'associative',
            'options' => $path . 'associative.html'
        ]);
        parent::init();
    }
}

