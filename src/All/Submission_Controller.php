<?php
namespace Formacopoeia\All;

class Submission_Controller extends \WP_Plugin_Maker\Custom_Type {
    public static $type = 'fc_submission';
	
    /**
	 * @priority(0)
	 */
	public static function action_init() {
		$labels = [
			'name'                  => _x('submission', 'Post Type General Name', 'submission'),
			'singular_name'         => _x('submission', 'Post Type Singular Name', 'submission'),
			'menu_name'             => __('submission', 'submission'),
			'name_admin_bar'        => __('submission', 'submission'),
			'archives'              => __('Item Archives', 'submission'),
			'parent_item_colon'     => __('Parent Item:', 'submission'),
			'all_items'             => __('All Items', 'submission'),
			'add_new_item'          => __('Add New Item', 'submission'),
			'add_new'               => __('Add New', 'submission'),
			'new_item'              => __('New Item', 'submission'),
			'edit_item'             => __('Edit Item', 'submission'),
			'update_item'           => __('Update Item', 'submission'),
			'view_item'             => __('View Item', 'submission'),
			'search_items'          => __('Search Item', 'submission'),
			'not_found'             => __('Not found', 'submission'),
			'not_found_in_trash'    => __('Not found in Trash', 'submission'),
			'featured_image'        => __('Featured Image', 'submission'),
			'set_featured_image'    => __('Set featured image', 'submission'),
			'remove_featured_image' => __('Remove featured image', 'submission'),
			'use_featured_image'    => __('Use as featured image', 'submission'),
			'insert_into_item'      => __('Insert into item', 'submission'),
			'uploaded_to_this_item' => __('Uploaded to this item', 'submission'),
			'items_list'            => __('Items list', 'submission'),
			'items_list_navigation' => __('Items list navigation', 'submission'),
			'filter_items_list'     => __('Filter items list', 'submission'),
        ];
		$args = [
			'label'                 => __('submission', 'submission'),
			'description'           => __('submission Description', 'submission'),
			'labels'                => $labels,
			'supports'              => ['title', 'custom-fields'],
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 4,
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => true,
			// 'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'menu_icon'			    => 'dashicons-post'
        ];

		register_post_type(self::$type, $args);
	}
}

