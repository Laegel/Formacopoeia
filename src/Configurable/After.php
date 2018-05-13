<?php
namespace Formacopoeia\Configurable;

class After extends Configurable {

    protected static $inited = false;
    protected static $items = [];

    protected static function init() {
        $path = \Formacopoeia\Plugin::$dir . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'afters' . DIRECTORY_SEPARATOR;
        $both_path = \Formacopoeia\Plugin::$dir . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'both' . DIRECTORY_SEPARATOR . 'afters' . DIRECTORY_SEPARATOR;
        
        self::$items[] = [
            'name' => 'notification',
            'options' => [
                'label' => 'Display a notification in the form',
                'path' => $path . 'notification.component.html',
                'action' => $both_path . 'notification.js'
            ]
        ];
        
        self::$items[] = [
            'name' => 'reload',
            'options' => [
                'label' => 'Reload the page',
                'path' => $path . 'reload.component.html',
                'action' => $both_path . 'reload.js'
            ]
        ];

        self::$items[] = [
            'name' => 'goto',
            'options' => [
                'label' => 'Go to page',
                'path' => $path . 'goto.component.html',
                'action' => $both_path . 'goto.js'
            ]
        ];

        self::$inited = true;
    }
}