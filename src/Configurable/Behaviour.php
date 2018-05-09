<?php
namespace Formacopoeia\Configurable;

class Behaviour extends Configurable {

    protected static $inited = false;
    protected static $items = [];

    protected static function init() {
        $path = \Formacopoeia\Plugin::$dir . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'admin' . DIRECTORY_SEPARATOR . 'behaviours' . DIRECTORY_SEPARATOR;
        self::$items[] = [
            'name' => 'mail',
            'options' => [
                'label' => 'Send mail',
                'path' => $path . 'mail.component.html',
                'callback' => 'Formacopoeia\Behaviours\Mail::handle'
            ]
        ];
        
        self::$items[] = [
            'name' => 'database',
            'options' => [
                'label' => 'Store in database',
                'path' => $path . 'database.component.html',
                'callback' => 'Formacopoeia\Behaviours\Database::handle'
            ]
        ];
        self::$inited = true;
    }
}

