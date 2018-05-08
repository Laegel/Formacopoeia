<?php
namespace Formacopoeia\Translations;

use Symfony\Component\Yaml\Yaml;

class Translator {

    private static $translations = [];

    public static function init() {
        self::$translations = Yaml::parseFile(WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'formacopoeia' . DIRECTORY_SEPARATOR . 'languages' . DIRECTORY_SEPARATOR . get_locale() . '.yaml');
    }

    public static function _t($string, $data = []) {
        echo self::translate($string, $data);
    }

    public static function t($string, $data = []) {
        return self::translate($string, $data);
    }

    public static function translate($string, $data = []) {
        $value = self::recursive_string_to_array(self::$translations, $string);
        return $value ? $value : $string;
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

