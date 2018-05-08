<?php
namespace Formacopoeia\Templating;

class Template_Controller extends \WP_Plugin_Maker\Controller {

    public static function init() {
        wp_enqueue_script('handlebars', WP_PLUGIN_URL . DIRECTORY_SEPARATOR . 'formacopoeia' . DIRECTORY_SEPARATOR . 'assets/libs/handlebars.min-latest.js');
        wp_enqueue_script('handlebars-helpers', WP_PLUGIN_URL . DIRECTORY_SEPARATOR . 'formacopoeia' . DIRECTORY_SEPARATOR . 'assets/libs/handlebars-helpers.js', ['handlebars']);
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
            var source   = '<?php echo addslashes(str_replace(["\r", "\n", "\r\n"], '', $string));?>';
            var template = Handlebars.compile(source);
            var result = template(<?php echo json_encode($data);?>);
            select('template-body[data-id="<?php echo $id;?>"]').innerHTML = result;
        </script>
        <?php
    }
}

