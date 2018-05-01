<?php
namespace Formacopoeia\All;

class Form_Controller extends \WP_Plugin_Maker\Custom_Type {
	public static $type = 'formacopoeia_form';
	public static $metas = [
		'tabs' => ['unique' => true],
		'field'
	];
	
    /**
	 * @priority(0)
	 */
	public static function action_init() {
		$labels = [
			'name'                  => _x('Form', 'Post Type General Name', 'form'),
			'singular_name'         => _x('Form', 'Post Type Singular Name', 'form'),
			'menu_name'             => __('Form', 'form'),
			'name_admin_bar'        => __('Form', 'form'),
			'archives'              => __('Item Archives', 'form'),
			'parent_item_colon'     => __('Parent Item:', 'form'),
			'all_items'             => __('All Items', 'form'),
			'add_new_item'          => __('Add New Item', 'form'),
			'add_new'               => __('Add New', 'form'),
			'new_item'              => __('New Item', 'form'),
			'edit_item'             => __('Edit Item', 'form'),
			'update_item'           => __('Update Item', 'form'),
			'view_item'             => __('View Item', 'form'),
			'search_items'          => __('Search Item', 'form'),
			'not_found'             => __('Not found', 'form'),
			'not_found_in_trash'    => __('Not found in Trash', 'form'),
			'featured_image'        => __('Featured Image', 'form'),
			'set_featured_image'    => __('Set featured image', 'form'),
			'remove_featured_image' => __('Remove featured image', 'form'),
			'use_featured_image'    => __('Use as featured image', 'form'),
			'insert_into_item'      => __('Insert into item', 'form'),
			'uploaded_to_this_item' => __('Uploaded to this item', 'form'),
			'items_list'            => __('Items list', 'form'),
			'items_list_navigation' => __('Items list navigation', 'form'),
			'filter_items_list'     => __('Filter items list', 'form'),
        ];
		$args = [
			'label'                 => __('form', 'form'),
			'description'           => __('form Description', 'form'),
			'labels'                => $labels,
			'supports'              => ['title', 'editor'],
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => false,
			'show_in_menu'          => true,
			'menu_position'         => 2,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => false,
			'publicly_queryable'    => false,
			'capability_type'       => 'post',
			'show_in_rest' 			=> true
        ];

		register_post_type(self::$type, $args);
	}
	
	public function get_fields() {
		return array_map('json_decode', get_post_meta($this->ID, 'field'));
	}

	public function add_field($field) {
		return add_post_meta($this->ID, 'field', json_encode($field));
	}
}

