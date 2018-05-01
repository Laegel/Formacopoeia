<?php
namespace Formacopoeia\All;

class Template2_Controller extends \WP_Plugin_Maker\Controller {

    public static function init() {
        wp_enqueue_script('handlebars', WP_PLUGIN_URL . DIRECTORY_SEPARATOR . 'formacopoeia' . DIRECTORY_SEPARATOR . 'assets/libs/handlebars.min-latest.js');
        wp_enqueue_script('handlebars-helpers', WP_PLUGIN_URL . DIRECTORY_SEPARATOR . 'formacopoeia' . DIRECTORY_SEPARATOR . 'assets/libs/handlebars-helpers.js', ['handlebars']);
    }
    public static function render_from($template, $data = []) {
        self::render(file_get_contents(WP_PLUGIN_DIR . DIRECTORY_SEPARATOR . 'formacopoeia' . DIRECTORY_SEPARATOR . 'templates' . DIRECTORY_SEPARATOR . $template . '.html'), $data);
    }

    public static function render($string, $data = []) {
        $id = md5(uniqid());
        ?>
        <template-body data-id="<?php echo $id;?>"></template-body>
        <script>
            var source   = '<?php echo addslashes(str_replace(["\r", "\n", "\r\n"], '', $string));?>';
            var template = Handlebars.compile(source);
            var result = template(<?php echo json_encode($data);?>);
            select('template-body[data-id="<?php echo $id;?>"]').innerHTML = result;
        </script>
        <?php
    }
}

