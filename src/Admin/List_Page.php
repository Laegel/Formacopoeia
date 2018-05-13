<?php
namespace Formacopoeia\Admin;

use \Formacopoeia\Translations\Translator;
use \Formacopoeia\Templating\Template_Controller;
use \Formacopoeia\All\Form_Controller as Forms;

class List_Page extends Page {

    const SLUG = 'formacopoeia-list';

    public static function register($options) {
        $options = [
            'menu_title' => Translator::t('menu.list'),
            'menu_slug' => self::SLUG,
            'icon_url' => 'dashicons-forms',
            'position' => 7
        ];
        parent::register($options);
    }

    public static function render() {
        $query = Forms::get();
        
        $forms = array_map(function($post) {
            return [
                'title' => $post->post_title,
                'link' => admin_url('/admin.php?page=' . Details_Page::SLUG . '&id=' . $post->ID)
            ];
        }, $query->posts);
        $pages = ceil($query->post_count / get_option('posts_per_page'));

        $formacopoeia_js = ['translations' => Translator::get_all()];
        self::send_to_client($formacopoeia_js);
        
        Template_Controller::render_from('admin' . DIRECTORY_SEPARATOR . 'list_page', compact(
            'forms', 'pages'
        ));
    }
}