<?php
namespace Formacopoeia\Admin;

abstract class Page {

    public static function register($options) {
        call_user_func_array('add_menu_page', self::resolve_args($options));
    }

    public static function register_submenu($options) {
        $args = self::resolve_args($options);
        array_unshift($args, $options['parent_slug']);
        call_user_func_array('add_submenu_page', $args);
    }

    private static function resolve_args($options) {
        extract($options);
        
        return [
            $page_title ?: $menu_title, 
            $menu_title, 
            'manage_options' ?: $capability, 
            $menu_slug ?: sanitize_title($menu_title), 
            function() use ($callable) {
                static::render();
            }, 
            $icon_url ?: '', 
            $position ?: null
        ];
    }

    abstract public static function render();
    
    protected static function send_to_client($formacopoeia) {
        ?>
        <script>var formacopoeia = <?php echo json_encode($formacopoeia);?>;</script>
        <?php
    }
}