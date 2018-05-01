<?php
namespace Formacopoeia\All;

class Template_Controller extends \WP_Plugin_Maker\Controller {

    private static $twig;

    public static function init() {
        self::use_twig();   
    }

    public static function use_twig() {
        self::$twig = new \Twig_Environment(new \Twig_Loader_String(), [
            'cache' => WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'formacopoeia' . DIRECTORY_SEPARATOR . 'cache',
            'debug' => true,
        ]);

        $filter = new \Twig_SimpleFilter('dump', function($string) {
            var_dump($string);
        });
        self::$twig->addFilter($filter);
        $filter = new \Twig_SimpleFilter('t', '\Formacopoeia\All\Translate_Controller::_t');
        self::$twig->addFilter($filter);
    }

    // Must provide a way to override default templates    

    public static function render($template, $data = []) {
        self::render_string(file_get_contents(WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'formacopoeia' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $template . '.twig'), $data);
    }

    public static function render_string($string, $data = []) {
        echo self::$twig->render($string, $data);
    }
}