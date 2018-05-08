<?php
namespace Formacopoeia\Configurable;

class Tab extends Configurable {

    protected static $inited = false;
    protected static $items = [];

    protected static function init() {
        $path = \Formacopoeia\Plugin::$dir . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'tabs' . DIRECTORY_SEPARATOR;
        array_unshift(self::$items, [
            'name' => 'editor',
            'options' => [
                'path' => $path . 'editor.html'
            ]
        ], [
            'name' => 'options',
            'options' => [
                'path' => $path . 'options.html'
            ]
        ], [
            'name' => 'behaviours',
            'options' => [
                'path' => $path . 'behaviours.html'
            ]
        ]);
        parent::init();
    }

}

