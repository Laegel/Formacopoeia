<?php
namespace Formacopoeia\Configurable;

abstract class Configurable {

    protected static $inited = false;
    protected static $items = [];

    protected static function init() {
        static::$inited = true;
    }

    public static function register($name, $options) {
        static::$items[] = compact('name', 'options');
    }

    public static function get_all() {
        if (!static::$inited) {
            static::init();
        }
        return static::$items;
    }

    public static function get_by_name($name) {
        if (!static::$inited) {
            static::init();
        }
        foreach (static::$items as $item) {
            if ($name === $item['name']) {
                return $item;
            }
        }
    }
}

