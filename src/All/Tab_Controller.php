<?php
namespace Formacopoeia\All;

class Tab_Controller extends Registerable_Controller {

    protected static $inited = false;
    protected static $items = [];

    protected static function init() {
        $path = \Formacopoeia\Plugin::$dir . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'tabs' . DIRECTORY_SEPARATOR;
        array_unshift(self::$items, [
            'name' => 'editor',
            'options' => $path . 'editor.html'
        ], [
            'name' => 'options',
            'options' => $path . 'options.html'
        ]);
        parent::init();
    }

}

