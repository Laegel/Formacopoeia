<?php
namespace Formacopoeia\Admin;

use \Formacopoeia\Templating\Template_Controller;
use \Formacopoeia\All\Form_Controller as Forms;
use \Formacopoeia\Translations\Translator;
use \Formacopoeia\Configurable\Field;
use \Formacopoeia\Configurable\Tab;
use \Formacopoeia\Configurable\Property;
use \Formacopoeia\Configurable\Theme;
use \Formacopoeia\Configurable\Behaviour;
use \Formacopoeia\Model\Submission;

use \Sunra\PhpSimple\HtmlDomParser;

class Form_Controller extends Admin_Controller {

    const SLUG_FORM_LIST = 'formacopoeia-list';
    const SLUG_FORM_DETAILS = 'formacopoeia-details';
    
    public static function action_admin_menu() {
		self::add_menu_page([
            'menu_title' => Translator::t('menu.list'),
            'menu_slug' => self::SLUG_FORM_LIST,
            'callable' => 'list_page',
            'icon_url' => 'dashicons-forms',
            'position' => 7
        ]);

        self::add_submenu_page([
            'parent_slug' => self::SLUG_FORM_LIST,
            'menu_title' => Translator::t('menu.edit'),
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

        $formacopoeia_js = ['translations' => Translator::get_all()];
        self::send_to_client($formacopoeia_js);
        
        Template_Controller::render_from('admin' . DIRECTORY_SEPARATOR . 'list_page', compact(
            'forms', 'pages'
        ));
    }

    public static function details_page() {
        $id = self::get_param('id');
        $args = !empty($id) ? self::prepare_update_form($id) : self::prepare_create_form();
        
        $fields = Field::get_all();
        $themes = Theme::get_all();
        $behaviours = Behaviour::get_all();
        $formacopoeia_js = compact('fields', 'themes', 'behaviours');
        $formacopoeia_js['currentForm'] = [
            'fields' => $args['form']['fields'] ?: [],
            'tabs' => $args['form']['tabs'] ?: ['behaviours' => []]
        ];
        $formacopoeia_js['components'] = [];
        $formacopoeia_js['properties'] = [];
        $formacopoeia_js['behavioursComponents'] = [];
        $formacopoeia_js['frontStyle'] = get_template_directory_uri() . '/style.css';
        $formacopoeia_js['translations'] = Translator::get_all();
        self::send_to_client($formacopoeia_js);

        $tabs = Tab::get_all();
        $args['tabs'] = $tabs;
        Template_Controller::render_from('admin' . DIRECTORY_SEPARATOR . 'details_page', $args);

        $properties = Property::get_all();

        self::output_fields_content($fields);
        self::output_tabs_content($tabs);
        self::output_behaviours_content($behaviours);
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

    private static function send_to_client($formacopoeia) {
        ?>
        <script>var formacopoeia = <?php echo json_encode($formacopoeia);?>;</script>
        <?php
    }

    private static function parse_component_file($path) {
        $component = trim(file_get_contents($path));
        $dom = HtmlDomParser::str_get_html($component, true, true, DEFAULT_TARGET_CHARSET, false);
        $template = $dom->find('template', 0);
        $script = $dom->find('script', 0);
        
        $template->setAttribute('type', 'text/x-handlebars-template');
        $template->tag = 'script';
        
        if (empty($template)) {
            var_dump('<template> tag not found in "' . $path . '"');
            continue;
        }
        return [
            'template' => $template,
            'script' => $script
        ];
    }

    private static function output_fields_content($fields = []) {
        foreach ($fields as $field) {
            extract(self::parse_component_file($field['options']['path']));
            $template->setAttribute('data-template-field', $field['name']);
            if (!empty($script)) {
                $script->setAttribute('data-script-field', $field['name']);
                $script->innertext = 'formacopoeia.fields.' . $field['name'] . ' = ' . $script->innertext;
            }
            echo $template;
            echo $script;
        }
    }

    private static function output_properties_content($properties = []) {
        foreach ($properties as $property) {
            extract(self::parse_component_file($property['options']['path']));
            $template->setAttribute('data-template-property', $property['name']);
            if (!empty($script)) {
                $script->setAttribute('data-script-property', $property['name']);
                $script->innertext = 'formacopoeia.properties.' . $property['name'] . ' = ' . $script->innertext;
            }
            echo $template;
            echo $script;
        }
    }

    private static function output_tabs_content($tabs = [], $themes = [], $behaviours = []) { // Rework todo
        
        foreach ($tabs as $tab) {
            extract(self::parse_component_file($tab['options']['path']));

            Template_Controller::look_for_parts($template);

            $template->setAttribute('data-template-tab', $tab['name']);
            if (!empty($script)) {
                $script->setAttribute('data-script-tab', $tab['name']);
                $script->innertext = 'formacopoeia.components.' . $tab['name'] . ' = ' . $script->innertext;
            }
            echo $template;
            echo $script;
        }
    }

    private static function output_behaviours_content($behaviours = []) {
        
        foreach ($behaviours as $behaviour) {
            extract(self::parse_component_file($behaviour['options']['path']));
            $template->setAttribute('data-template-behaviour', $behaviour['name']);
            if (!empty($script)) {
                $script->setAttribute('data-script-behaviour', $behaviour['name']);
                $script->innertext = 'formacopoeia.behavioursComponents.' . $behaviour['name'] . ' = ' . $script->innertext;
            }
            echo $template;
            echo $script;
        }
    }
 
    /**
     * @ajax
     */
    public static function action_save_form() {
        $response = [];
        $id = sanitize_text_field($_POST['id']);
        if (isset($id)) {
            $done = self::update_form($id); 
            var_dump($done);
        } else {
            $id = self::create_form();
        }
        self::set_form_meta($id);
        die(json_encode($response));
    }

    private static function update_form($id) {
        return wp_update_post([
            'ID' => $id,
            'post_title' => sanitize_text_field($_POST['title']),
            'post_status' => 'true' === sanitize_text_field($_POST['status']) ? 'publish' : 'draft'
        ]);
    }

    private static function create_form() {
        return wp_create_post(['post_title' => sanitize_text_field($_GET['title'])]);
    }

    private static function set_form_meta($id) {
        $fields = self::sanitize($_POST['fields']);
        delete_post_meta($id, 'field');
        foreach ($fields as $field) {
            add_post_meta($id, 'field', json_encode($field));
        }
        update_post_meta($id, 'tabs', self::sanitize($_POST['tabs']));
    }

    /**
     * @ajax(1)
     * @ajax_nopriv(1)
     */
    public static function action_get_form() {
        $response = [];
        $id = sanitize_text_field($_GET['id']);
        $token = sanitize_text_field($_GET['token']);
        
        if (empty($id) || !get_transient($token)) {
            self::die_json(['message' => 'Invalid id or token'], 400);
        }
        delete_transient($token);
        $form = Forms::get_by_id($id);
        $response['form'] = $form->get_fields($id);
        self::die_json($response);
    }

    /**
     * @cache(3600)
     * @ajax
     * @ajax_nopriv
     */
    public static function action_get_fields() {
        $response = [
            'fields' => []
        ];
        $fields = Field::get_all();
        foreach ($fields as $field) {
            $response['fields'][$field['name']] = $field['options']['template'];
        }

        self::die_json($response);
    }

    /**
     * @ajax
     * @ajax_nopriv
     * @priority(0)
     */
    public static function action_submit_formacopoeia() {
        $id = sanitize_text_field($_POST['id']);
        if (isset($id) && !wp_verify_nonce($_POST['nonce'], 'formacopoeia_form_' . $id)) {
            $response['is_valid'] = false;
            $response['message'] = 'Invalid id or nonce';
            self::die_json($response, 400);
        }
        $response = [];
        $form = Forms::get_by_id($id);
        $submission = new Submission($form, self::sanitize($_POST['formacopoeia']));
        if ($valid = $submission->validate()) {
            $submission->dispatch_behaviours();
            $response['is_valid'] = true;
            $response['message'] = 'Form submited!';
        } else {
            $response['is_valid'] = false;
            $response['errors'] = $submission->get_errors();
        }
        self::die_json($response);
    }
}