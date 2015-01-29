<?php
/**
 * Trainings Post Type
 *
 * @package   naffa2015
 * @author    Big William <hello@bigwilliam.com>
 * @license   MIT
 * @link      http://bigwilliam.com/
 * @copyright 2015 Big William
 */

class Custom_Events_Post_Type {

	/**
	 * Initialize the plugin.
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function __construct() {

		// Register Post Type
		add_action( 'init', array( $this, 'register_posttype'), 0 );

		// Custom title text
		add_action( 'init', array( $this, 'custom_title'), 0);

		// Register Custom Taxonimies
		add_action( 'init', array( $this, 'register_taxonomies'), 0);

		// Register Shortcodes
		// 	add_action( 'init', array( $this, 'register_shortcodes'), 0 );

		// Load ACF Fields
		// add_action( 'init', array( $this, 'register_acf_fields'), 0);
	}

	/**
	 * Register Post Type
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function register_posttype() {

		$labels = array(
			'name'                => _x( 'Events', 'Post Type General Name', 'roots' ),
			'singular_name'       => _x( 'Event', 'Post Type Singular Name', 'roots' ),
			'menu_name'           => __( 'Events', 'roots' ),
			'parent_item_colon'   => __( 'Parent event:', 'roots' ),
			'all_items'           => __( 'All events', 'roots' ),
			'view_item'           => __( 'View event', 'roots' ),
			'add_new_item'        => __( 'Add New Event', 'roots' ),
			'add_new'             => __( 'New Event', 'roots' ),
			'edit_item'           => __( 'Edit Event', 'roots' ),
			'update_item'         => __( 'Update Event', 'roots' ),
			'search_items'        => __( 'Search Events', 'roots' ),
			'not_found'           => __( 'Not found', 'roots' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'roots' ),
		);
		$rewrite = array(
			'slug'                => 'events',
			'with_front'          => true,
			'pages'               => true,
			'feeds'               => true,
		);
		$args = array(
			'label'               => __( 'event', 'roots' ),
			'description'         => __( 'Trainings, Seminars and Conferences', 'roots' ),
			'labels'              => $labels,
			'supports'            => array( 'title', 'editor', 'thumbnail'),
			'taxonomies'          => array( 'event-type', 'tag'),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-calendar-alt',
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => true,
			'publicly_queryable'  => true,
			'rewrite'             => $rewrite,
			'capability_type'     => 'page',
		);
		register_post_type( 'custom_events', $args );
	}

	/**
	 * Custom Title
	 * examples: http://codex.wordpress.org/Function_Reference/register_taxonomy
	 * @since  1.0.0
	 * @return void
	 */
	public function custom_title() {

		function custom_event_title( $input ) {
		  global $post_type;

		  if ( is_admin() && 'naffa_events' == $post_type ) {
		    return __( 'Event Title', 'roots' );
		  }

		  return $input;
		}

		add_filter( 'enter_title_here', 'custom_event_title' );
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
      'name'              => _x( 'Event Type', 'taxonomy general name' ),
      'singular_name'     => _x( 'Event Type', 'taxonomy singular name' ),
      'search_items'      => __( 'Search Event Types' ),
      'all_items'         => __( 'All Event Types' ),
      'parent_item'       => __( 'Parent Type' ),
      'parent_item_colon' => __( 'Parent Type:' ),
      'edit_item'         => __( 'Edit Event Type' ),
      'update_item'       => __( 'Update Event Type' ),
      'add_new_item'      => __( 'Add New Event Type' ),
      'new_item_name'     => __( 'New Event Type Name' ),
      'menu_name'         => __( 'Event Type' ),
    );

    $args = array(
      'hierarchical'      => true,
      'labels'            => $labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => 'events' ),
    );

    register_taxonomy( 'custom_event_type', array( 'custom_events' ), $args );
	
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
$custom_events_post_type = new Custom_Events_Post_Type();
