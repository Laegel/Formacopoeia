<?php
namespace Formacopoeia\All;

use Symfony\Component\Yaml\Yaml;

class Translate_Controller extends \WP_Plugin_Maker\Controller {

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
        return self::$translations[$string] ?: $string;
    }

}

