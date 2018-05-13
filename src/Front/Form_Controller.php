<?php
namespace Formacopoeia\Front;

use \Formacopoeia\All\Form_Controller as Form;
use \Formacopoeia\Configurable\Property;
use \Formacopoeia\Configurable\After;
use \Formacopoeia\Plugin;

use \Sunra\PhpSimple\HtmlDomParser;

class Form_Controller extends \WP_Plugin_Maker\Controller {

    public static $inited = false;

    public static function init() {
        self::$inited = true;
        ?>
        <script>formacopoeia = {fields: {}, afters: {}};</script>
        <?php
        wp_enqueue_script('fc-core-front', Plugin::$url . '/assets/front/core.js', ['fc-utils']);
        $properties = Property::get_all();
    }

    public static function render_form_slot(Form $form) {
        self::enqueue_form_after_script($form);
        self::enqueue_form_fields_scripts($form);
        ob_start();
        require_once implode(DIRECTORY_SEPARATOR, [
            Plugin::$dir, 'templates', 'front', 'form.php'
        ]);
        return ob_get_clean();
    }

    private static function enqueue_form_after_script(Form $form) {
        $tabs = $form->get_tabs();
        $afters = After::get_all();
        foreach ($afters as $after) {
            if ($after['name'] === $tabs->after->name && file_exists($after['options']['action'])) {
                $function = file_get_contents($after['options']['action']);
                ?>
                <script>
                    formacopoeia.afters.<?php echo $after['name'];?> = <?php echo $function;?>
                </script>
                <?php
                break;
            }
        }
        
    }

    private static function enqueue_form_fields_scripts(Form $form) {
        $fields = $form->get_fields();
        foreach ($fields as $field) {
            $path = implode(DIRECTORY_SEPARATOR, [
                Plugin::$dir, 'assets', 'both', 'fields', $field->type . '.component.html'
            ]);
            if (!file_exists($path)) {
                continue;
            }
            $component = file_get_contents($path);
            $dom = HtmlDomParser::str_get_html($component, true, true, DEFAULT_TARGET_CHARSET, false);
            $script = $dom->find('script', 0);
            if (!empty($script)) {
                ?>
                <script>formacopoeia.fields['<?php echo $field->type;?>'] = <?php echo $script->innertext;?>;</script>
                <?php
            }
        }
    }
}

