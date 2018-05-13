<?php
namespace Formacopoeia\Models;

class Form extends WP_Plugin_Maker\Model {

    public static $type = 'fc_form';

    public function get_fields() {
		return array_map('json_decode', get_post_meta($this->ID, 'field'));
	}

	public function add_field($field) {
		return add_post_meta($this->ID, 'field', json_encode($field));
	}

	public function get_tabs() {
		return json_decode(json_encode(get_post_meta($this->ID, 'tabs', true)));
    }
    
    public static function get_published_by_id($id) {
		$args = static::get_default_args();
        $args['posts_per_page'] = 1;
        $args['post_status'] = 'publish';
		$args['post__in'] = [$id];
		$query = new WP_Query($args);
		return static::wrap($query->post);
    }
    
}