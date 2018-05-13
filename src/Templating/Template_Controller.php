<?php
namespace Formacopoeia\Templating;

use \Formacopoeia\Plugin;

class Template_Controller extends \WP_Plugin_Maker\Controller {

    public static function init() {
        wp_enqueue_script('fc-handlebars', Plugin::$url . '/assets/libs/handlebars.min-latest.js');
        wp_enqueue_script('fc-handlebars-helpers', Plugin::$url . '/assets/libs/handlebars-helpers.js', ['fc-handlebars']);
    }

    private static function save_part($name, $content) {
        ?>
        <script type="text/x-handlebars-template" data-template-part="<?php echo $name;?>"><?php echo $content;?></script>
        <?php
    }

    public static function look_for_parts($node) {
        $parts = [];
        $nodes = $node->find('[data-renderer-part]');
        foreach ($nodes as $node) {
            self::save_part($node->attr['data-renderer-part'], $node->innertext);
        }
    }

    public static function render_from($template, $data = []) {
        self::render(file_get_contents(WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'formacopoeia' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $template . '.html'), $data);
    }

    public static function to_handlebars($string, $data = []) {
        ?>
        <script type="text/x-handlebars-template"><?php echo $string;?></script>
        <?php
    }

    public static function render($string, $data = []) {
        $id = md5(uniqid());
        ?>
        <template-body data-id="<?php echo $id;?>"></template-body>
        <script type="text/javascript">
            window.fctmp = {};
            window.fctmp.source   = '<?php echo addslashes(str_replace(["\r", "\n", "\r\n"], '', $string));?>';
            window.fctmp.template = Handlebars.compile(window.fctmp.source);
            window.fctmp.result = window.fctmp.template(<?php echo json_encode($data);?>);
            fcUtils.select('template-body[data-id="<?php echo $id;?>"]').innerHTML = window.fctmp.result;
            delete window.fctmp;
        </script>
        <?php
    }
}

