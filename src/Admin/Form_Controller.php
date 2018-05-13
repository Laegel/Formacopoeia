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
use \Formacopoeia\Behaviours\Submission;

use \Sunra\PhpSimple\HtmlDomParser;

class Form_Controller extends Admin_Controller {

    public static function action_admin_menu() {
        List_Page::register();
        Details_Page::register_submenu();
	}
 
    /**
     * @ajax
     */
    public static function action_save_form() {
        $response = [];
        $id = sanitize_text_field($_POST['id']);
        if (!empty($id)) {
            self::update_form($id); 
        } else {
            $id = self::create_form();
        }
        var_dump($id);
        self::set_form_meta($id);
        die(json_encode($response));
    }

    private static function update_form($id) {
        return wp_update_post([
            'ID' => $id,
            'post_title' => sanitize_text_field($_POST['title']),
            'post_content' => $_POST['content'],
            'post_status' => 'true' === sanitize_text_field($_POST['status']) ? 'publish' : 'draft'
        ]);
    }

    private static function create_form() {
        return wp_insert_post([
            'post_title' => sanitize_text_field($_POST['title']),
            'post_content' => $_POST['content'],
            'post_status' => 'true' === sanitize_text_field($_POST['status']) ? 'publish' : 'draft'
        ]);
    }

    private static function set_form_meta($id) {
        $is = function($to_check, $expected, $default) {
            return isset($to_check) && $to_check === $expected ? $expected : $default; 
        };

        $fields = self::sanitize($_POST['fields']);
        delete_post_meta($id, 'field');
        foreach ($fields as $field) {
            add_post_meta($id, 'field', json_encode($field));
        }
        $tabs = [];
        $behaviours = Behaviour::get_all();
        foreach ($_POST['tabs'] as $key => $tab) {
            if ('behaviours' === $key) {
                foreach ($tab as $index => $savedBehaviour) {
                    foreach ($behaviours as $behaviour) {
                        if ($behaviour['name'] === $savedBehaviour['name'] && isset($behaviour['options']['values'])) {
                            foreach ($behaviour['options']['values'] as $valueKey => $value) {
                                $tabs[$key][$index]['values'][$valueKey] = $is($value['sanitize'], false, true) ? self::sanitize($savedBehaviour['values'][$valueKey]) : $savedBehaviour['values'][$valueKey];
                            }
                            $tabs[$key][$index]['name'] = $behaviour['name'];
                            break;
                        } else {
                            $tabs[$key][$index] = self::sanitize($savedBehaviour);
                            break;
                        }
                    }
                }
            } else {
                $tabs[$key] = self::sanitize($tab);
            }
        }
        update_post_meta($id, 'tabs', $tabs);
    }

    /**
     * @ajax
     * @ajax_nopriv
     */
    public static function action_get_form() {
        $response = [];
        $id = sanitize_text_field($_GET['id']);
        $token = sanitize_text_field($_GET['token']);
        
        // if (empty($id) || !get_transient($token)) {
        //     self::die_json(['message' => 'Invalid id or token'], 400);
        // }
        // delete_transient($token);
        $form = Forms::get_by_id($id);
        $response['form'] = $form->get_fields($id);
        self::die_json($response);
    }

    /**
     * @ajax
     * @ajax_nopriv
     * @admin_post
     * @admin_post_nopriv
     * @priority(0)
     */
    public static function action_formacopoeia_submit() {
        $id = sanitize_text_field($_POST['id']);
        $token = sanitize_text_field($_POST['token']);
        
        $response = self::check_security($id, $token);

        if (!isset($response['is_valid']) || $response['is_valid']) {
            $response = self::check_form($id);
        }

        if (defined('DOING_AJAX') && DOING_AJAX) {
            self::die_json($response);
        } else {
            setcookie('fc-message', json_encode($response));
            wp_redirect($_SERVER['HTTP_REFERER']);
            die;
        }
    }
    
    private static function check_security($id, $token) {
        $response = [];
        if (!is_numeric($id) && !wp_verify_nonce($_POST['nonce'], 'formacopoeia_form_' . $token)) {
            $response['is_valid'] = false;
            $response['message'] = 'Invalid id or nonce';
        }
        return $response;
    }

    private static function check_form($id) {
        $response = [];
        $form = Forms::get_by_id($id);
        $tabs = $form->get_tabs();
        $submission = new Submission($form, self::sanitize($_POST['formacopoeia']));
        if ($valid = $submission->validate()) {
            $submission->dispatch_behaviours();
            $response['is_valid'] = true;
            $response['message'] = 'Form submited!';
            $response['after'] = $tabs->after;
        } else {
            $response['is_valid'] = false;
            $response['errors'] = $submission->get_errors();
        }
        return $response;
    }
}