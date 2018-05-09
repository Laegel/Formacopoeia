<?php
namespace Formacopoeia\Configurable;

class Property extends Configurable {

    protected static $inited = false;
    protected static $items = [];

    protected static function init() {
        $path = \Formacopoeia\Plugin::$dir . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'properties' . DIRECTORY_SEPARATOR;
        array_unshift(self::$items, [
            'name' => 'text',
            'options' => [
                'path' => $path . 'text.component.html'
            ]
        ], [
            'name' => 'textarea',
            'options' => [
                'path' => $path . 'textarea.component.html'
            ]
        ], [
            'name' => 'checkbox',
            'options' => [
                'path' => $path . 'checkbox.component.html'
            ]
        ], [
            'name' => 'associative',
            'options' => [
                'path' => $path . 'associative.component.html'
            ]
        ], [
            'name' => 'list',
            'options' => [
                'path' => $path . 'list.component.html'
            ]
        ], [
            'name' => 'number',
            'options' => [
                'path' => $path . 'number.component.html'
            ]
        ]);
        parent::init();
    }
}

