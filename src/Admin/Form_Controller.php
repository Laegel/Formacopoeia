<?php
namespace Formacopoeia\Admin;

use \Formacopoeia\All\Template2_Controller;
use \Formacopoeia\All\Translate_Controller;
use \Formacopoeia\All\Form_Controller as Forms;
use \Formacopoeia\All\Field_Controller;
use \Formacopoeia\All\Tab_Controller;
use \Formacopoeia\All\Property_Controller;
use \Formacopoeia\All\Theme_Controller;

use \Sunra\PhpSimple\HtmlDomParser;

class Form_Controller extends Admin_Controller {

    const SLUG_FORM_LIST = 'formacopoeia-list';
    const SLUG_FORM_DETAILS = 'formacopoeia-details';
    
    public static function action_admin_menu() {
		self::add_menu_page([
            'menu_title' => Translate_Controller::t('formList'),
            'menu_slug' => self::SLUG_FORM_LIST,
            'callable' => 'list_page',
            'icon_url' => 'dashicons-forms',
            'position' => 7
        ]);

        self::add_submenu_page([
            'parent_slug' => self::SLUG_FORM_LIST,
            'menu_title' => Translate_Controller::t('formEdit'),
            'menu_slug' => self::SLUG_FORM_DETAILS,
            'callable' => 'details_page'
        ]);
	}

	public static function list_page() {
        $query = Forms::get();
        
        $forms = array_map(function($post) {
            return [
                'title' => $post->post_title,
                'link' => admin_url('/admin.php?page=' . self::SLUG_FORM_DETAILS . '&id=' . $post->ID)
            ];
        }, $query->posts);
        $pages = ceil($query->post_count / get_option('posts_per_page'));
        
        Template2_Controller::render_from('admin' . DIRECTORY_SEPARATOR . 'list_page', compact(
            'forms', 'pages'
        ));
    }

    public static function details_page() {
        $id = self::get_param('id');
        $args = !empty($id) ? self::prepare_update_form($id) : self::prepare_create_form();
        
        $fields = Field_Controller::get_all();
        $themes = Theme_Controller::get_all();
        $formacopoeia_js = compact('fields', 'themes');
        $formacopoeia_js['currentForm'] = $args['form']['ast'] ?: [];
        $formacopoeia_js['components'] = [];
        $formacopoeia_js['properties'] = [];
        $formacopoeia_js['frontStyle'] = get_template_directory_uri() . '/style.css';
        self::send_to_client($formacopoeia_js);

        $tabs = Tab_Controller::get_all();
        $args['tabs'] = $tabs;
        Template2_Controller::render_from('admin' . DIRECTORY_SEPARATOR . 'details_page', $args);
        self::output_tabs_content($tabs, $themes);

        $properties = Property_Controller::get_all();
        self::output_properties_content($properties);

        wp_enqueue_script('fc-core', WP_PLUGIN_URL . DIRECTORY_SEPARATOR . 'formacopoeia' . DIRECTORY_SEPARATOR . 'assets/admin/core.js', ['jquery']);
        wp_enqueue_style('fc-style', WP_PLUGIN_URL . DIRECTORY_SEPARATOR . 'formacopoeia' . DIRECTORY_SEPARATOR . 'assets/admin/css/core.css');
    }

    protected static function prepare_update_form($id) {
        $form = Forms::get_by_id($id);
        return [
            'action' => 'update',
            'form' => [
                'title' => $form->post_title,
                'ast' => $form->get_fields()
            ]
        ];
    }

    protected static function prepare_create_form() {
        return [
            'action' => 'create'
        ];
    }

    private static function send_to_client($formacopoeia) {
        ?>
        <script>var formacopoeia = <?php echo json_encode($formacopoeia);?>;</script>
        <?php
    }

    private static function output_properties_content($properties = []) {
        foreach ($properties as $property) {
            $component = trim(file_get_contents($property['options']));
            $dom = HtmlDomParser::str_get_html($component, true, true, DEFAULT_TARGET_CHARSET, false);
            $template = $dom->find('template', 0);
            if (empty($template)) {
                var_dump('<template> tag not found in "' . $property['options'] . '"');
                continue;
            }
            $template->setAttribute('data-property', $property['name']);
            $script = $dom->find('script', 0);
            if (!empty($script)) {
                $script->setAttribute('data-property', $property['name']);
                $script->innertext = 'formacopoeia.properties.' . $property['name'] . ' = ' . $script->innertext;
            }
            echo $template;
            echo $script;
        }
    }

    private static function output_tabs_content($tabs = [], $themes = []) {
        
        foreach ($tabs as $tab) {
            $component = trim(file_get_contents($tab['options']));
            $dom = HtmlDomParser::str_get_html($component, true, true, DEFAULT_TARGET_CHARSET, false);
            $template = $dom->find('template', 0);
            if (empty($template)) {
                var_dump('<template> tag not found in "' . $tab['options'] . '"');
                continue;
            }
            $template->setAttribute('data-tab', $tab['name']);
            $script = $dom->find('script', 0);
            if (!empty($script)) {
                $script->setAttribute('data-tab', $tab['name']);
                $script->innertext = 'formacopoeia.components.' . $tab['name'] . ' = ' . $script->innertext;
            }
            echo Template2_Controller::render((string)$template, ['themes' => $themes]);
            echo $script;
        }
    }
 
    /**
     * @ajax(1)
     */
    public static function action_save_form() {
        $response = [];
        $id = sanitize_text_field($_POST['id']);
        if (isset($id)) {
            self::update_form($id); 
        } else {
            $id = self::create_form();
        }
        self::set_form_meta($id);
        die(json_encode($response));
    }

    private static function update_form($id) {
        return wp_update_post([
            'id' => $id,
            'post_title' => sanitize_text_field($_GET['title'])
        ]);
    }

    private static function create_form() {
        return wp_create_post(['post_title' => sanitize_text_field($_GET['title'])]);
    }

    private static function set_form_meta($id) {
        $ast = self::sanitize($_POST['ast']);
        delete_post_meta($id, 'field');
        foreach ($ast as $field) {
            add_post_meta($id, 'field', json_encode($field));
        }
        update_post_meta($id, 'tabs', self::sanitize($_POST['tabs']));
    }

    /**
     * @ajax(1)
     */
    public static function action_get_form() {
        $response = [];
        $id = sanitize_text_field($_GET['id']);
        if (empty($id)) {
            self::die_json('Invalid id', 400);
        }
        $form = Forms::get_by_id($id);
        $response['form'] = $form->get_fields($id);
        self::die_json($response);
    }

    /**
     * @cache(3600)
     * @ajax(1)
     */
    public static function action_get_fields() {
        $response = [
            'fields' => []
        ];
        $fields = Field_Controller::get_all();
        foreach ($fields as $field) {
            $response['fields'][$field['name']] = $field['options']['template'];
        }

        self::die_json($response);
    }
}