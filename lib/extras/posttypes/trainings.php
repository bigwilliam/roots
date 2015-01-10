<?php
/**
 * Trainings Post Type
 *
 * @package   roots-reloaded
 * @author    Big William <hello@bigwilliam.com>
 * @license   MIT
 * @link      http://bigwilliam.com/
 * @copyright 2015 Big William
 */

class Custom_Training_Post_Type {

	/**
	 * Initialize the plugin.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function __construct() {

		// Register Post Type
		add_action( 'init', array( $this, 'register_posttype'), 0 );

		// Register Custom Taxonimies
		// add_action( 'init', array( $this, 'register_taxonomies'), 0);

		// Register Shortcodes
		// 	add_action( 'init', array( $this, 'register_shortcodes'), 0 );

		// Load ACF Fields

	}

	/**
	 * Register Post Type: sliders
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function register_posttype() {

		$labels = array(
			'name'                => _x( 'Trainings', 'Post Type General Name', 'roots' ),
			'singular_name'       => _x( 'Training', 'Post Type Singular Name', 'roots' ),
			'menu_name'           => __( 'Trainings', 'roots' ),
			'parent_item_colon'   => __( 'Parent training:', 'roots' ),
			'all_items'           => __( 'All trainings', 'roots' ),
			'view_item'           => __( 'View training', 'roots' ),
			'add_new_item'        => __( 'Add New training', 'roots' ),
			'add_new'             => __( 'New training', 'roots' ),
			'edit_item'           => __( 'Edit training', 'roots' ),
			'update_item'         => __( 'Update training', 'roots' ),
			'search_items'        => __( 'Search trainings', 'roots' ),
			'not_found'           => __( 'Not found', 'roots' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'roots' ),
		);
		$rewrite = array(
			'slug'                => 'training',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);
		$args = array(
			'label'               => __( 'training', 'roots' ),
			'description'         => __( 'trainings', 'roots' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail'),
			'taxonomies'          => array( 'category'),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => plugins_url( '/img/wp-icon-slides.png', __FILE__ ),
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);
		register_post_type( 'custom_training', $args );
	}


	/**
	 * Register Taxonomies for this Post Type
	 * examples: http://codex.wordpress.org/Function_Reference/register_taxonomy
	 * @since  1.0.0
	 * @return void
	 */

	public function register_taxonomies() {

		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Slide Group', 'taxonomy general name' ),
			'singular_name'     => _x( 'Slide Group', 'taxonomy singular name' ),
			'search_items'      => __( 'Search Groups' ),
			'all_items'         => __( 'All Groups' ),
			'parent_item'       => __( 'Parent Group' ),
			'parent_item_colon' => __( 'Parent Group:' ),
			'edit_item'         => __( 'Edit Group' ),
			'update_item'       => __( 'Update Group' ),
			'add_new_item'      => __( 'Add New Group' ),
			'new_item_name'     => __( 'New Group Name' ),
			'menu_name'         => __( 'Groups' ),
		);

		$args = array(
			'hierarchical'      => true,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'group' ),
		);

		register_taxonomy( 'group', array( 'slides' ), $args );

		// Add new taxonomy, NOT hierarchical (like tags)
		$labels = array(
			'name'                       => _x( 'Writers', 'taxonomy general name' ),
			'singular_name'              => _x( 'Writer', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Writers' ),
			'popular_items'              => __( 'Popular Writers' ),
			'all_items'                  => __( 'All Writers' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Writer' ),
			'update_item'                => __( 'Update Writer' ),
			'add_new_item'               => __( 'Add New Writer' ),
			'new_item_name'              => __( 'New Writer Name' ),
			'separate_items_with_commas' => __( 'Separate writers with commas' ),
			'add_or_remove_items'        => __( 'Add or remove writers' ),
			'choose_from_most_used'      => __( 'Choose from the most used writers' ),
			'not_found'                  => __( 'No writers found.' ),
			'menu_name'                  => __( 'Writers' ),
		);

		$args = array(
			'hierarchical'          => false,
			'labels'                => $labels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'rewrite'               => array( 'slug' => 'writer' ),
		);

		register_taxonomy( 'writer', 'slides', $args );
	}



	/**
	 * Register Shortcodes
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function register_shortcodes() {}


	/**
	 * Register Custom Fields
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function register_acf_fields() {}

}
$custom_trainings = new Custom_Training_Post_Type();
