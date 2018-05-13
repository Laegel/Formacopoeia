<?php
namespace Formacopoeia\Translations;

use Symfony\Component\Yaml\Yaml;

class Translator {

    private static $translations = [];

    public static function init() {
        self::$translations = Yaml::parseFile(\Formacopoeia\Plugin::$dir . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR . get_locale() . '.yaml');
    }

    public static function _t($key, $data = []) {
        echo self::translate($key, $data);
    }

    public static function t($key, $data = []) {
        return self::translate($key, $data);
    }

    public static function translate($key, $data = []) {
        $value = self::recursive_string_to_array(self::$translations, $key);
        return $value ? $value : $key;
    }

    private static function recursive_string_to_array($data, $key) {
        $e = explode('.', $key, 2);
        if (is_array($data[$e[0]])) {
            return self::recursive_string_to_array($data[$e[0]], $e[1]);
        } elseif (false === strpos($key, '.')) {
            return $data[$e[0]];
        } else {
            return false;
        }
    }

    public static function get_all() {
        return self::$translations;
    }
}

