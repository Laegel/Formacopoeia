<?php
namespace Formacopoeia\Admin;

use \Formacopoeia\Plugin;
use \Formacopoeia\Translations\Translator;
use \Formacopoeia\Templating\Template_Controller;
use \Formacopoeia\All\Form_Controller as Forms;
use \Formacopoeia\Configurable\Field;
use \Formacopoeia\Configurable\Tab;
use \Formacopoeia\Configurable\Property;
use \Formacopoeia\Configurable\Theme;
use \Formacopoeia\Configurable\Behaviour;
use \Formacopoeia\Configurable\After;

use \Sunra\PhpSimple\HtmlDomParser;

class Details_Page extends Page {

    const SLUG = 'formacopoeia-details';

    public static function register_submenu($options) {
        $options = [
            'parent_slug' => List_Page::SLUG,
            'menu_title' => Translator::t('menu.edit'),
            'menu_slug' => self::SLUG,
        ];
        parent::register_submenu($options);

        
    }

    private static function parse_component_file($path) {
        $component = trim(file_get_contents($path));
        $dom = HtmlDomParser::str_get_html($component, true, true, DEFAULT_TARGET_CHARSET, false);
        
        $template = $dom->find('template', 0);
        
        if (empty($template)) {
            var_dump('<template> tag not found in "' . $path . '"');
            return;
        }

        $script = $dom->find('script', 0);
        
        $template->setAttribute('type', 'text/x-handlebars-template');
        $template->tag = 'script';
        
        return [
            'template' => $template,
            'script' => $script
        ];
    }

    private static function output_template_content($type, $property, $data = []) {
        foreach ($data as $item) {
            if (!file_exists($item['options']['path'])) {
                var_dump($item['options']['path'] . ' does not exist!');
                continue;
            }
            extract(self::parse_component_file($item['options']['path']));
            
            Template_Controller::look_for_parts($template);
            $template->setAttribute('data-template-' . $type, $item['name']);
            if (!empty($script)) {
                $script->setAttribute('data-script-' . $type, $item['name']);
                $script->innertext = 'formacopoeia.' . $property . '.' . $item['name'] . ' = ' . $script->innertext;
            }
            echo $template;
            echo $script;
        }
    }

    public static function render() {
        wp_enqueue_editor();

        $id = sanitize_text_field($_GET['id']);
        $args = !empty($id) ? self::prepare_update_form($id) : self::prepare_create_form();
        
        $fields = Field::get_all();
        $themes = Theme::get_all();
        $behaviours = Behaviour::get_all();
        $afters = After::get_all();
        $formacopoeia_js = compact('fields', 'themes', 'behaviours', 'afters');
        $formacopoeia_js['currentForm'] = [
            'fields' => $args['form']['fields'] ?: [],
            'tabs' => $args['form']['tabs'] ?: ['behaviours' => []]
        ];
        $formacopoeia_js['components'] = [];
        $formacopoeia_js['properties'] = [];
        $formacopoeia_js['fieldsComponents'] = [];
        $formacopoeia_js['behavioursComponents'] = [];
        $formacopoeia_js['aftersComponents'] = [];
        $formacopoeia_js['frontStyle'] = get_template_directory_uri() . '/style.css';
        $formacopoeia_js['translations'] = Translator::get_all();
        self::send_to_client($formacopoeia_js);

        $tabs = Tab::get_all();
        $args['tabs'] = $tabs;
        Template_Controller::render_from('admin' . DIRECTORY_SEPARATOR . 'details_page', $args);

        $properties = Property::get_all();

        self::output_template_content('field', 'fieldsComponents', $fields);
        self::output_template_content('tab', 'components', $tabs);
        self::output_template_content('behaviour', 'behavioursComponents', $behaviours);
        self::output_template_content('property', 'properties', $properties);
        self::output_template_content('after', 'aftersComponents', $afters);

        wp_enqueue_script('fc-core-admin', Plugin::$url . '/assets/admin/core.js', ['fc-utils']);
        wp_enqueue_style('fc-style', Plugin::$url . '/assets/admin/css/core.css');
    }

    protected static function prepare_update_form($id) {
        $form = Forms::get_by_id($id);
        return [
            'action' => 'update',
            'form' => [
                'title' => $form->post_title,
                'status' => 'publish' === $form->post_status,
                'fields' => $form->get_fields(),
                'tabs' => $form->get_tabs()
            ]
        ];
    }

    protected static function prepare_create_form() {
        return [
            'action' => 'create'
        ];
    }
}