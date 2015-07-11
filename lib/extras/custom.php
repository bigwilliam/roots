<?php
/**
 * Clean up the_excerpt()
 */
function roots_excerpt_more() {
  return ' &hellip; <a href="' . get_permalink() . '">' . __('Continued', 'roots') . '</a>';
}
add_filter('excerpt_more', 'roots_excerpt_more');

/**
 * Excerpt Length
 */
function custom_excerpt_length( $length ) {
  return 20;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

/**
 * Manage output of wp_title()
 */
function roots_wp_title($title) {
  if (is_feed()) {
    return $title;
  }

  $title .= get_bloginfo('name');

  return $title;
}
add_filter('wp_title', 'roots_wp_title', 10);

/*
 * => Turn off default image links
 * ---------------------------------------------------------------------------*/

function imagelink_setup() {
  $image_set = get_option( 'image_default_link_type' );
  if ($image_set !== 'none') {
    update_option('image_default_link_type', 'none');
  }
}
add_action('admin_init', 'imagelink_setup', 10);


/*
 * => Allow Editors to edit Gravity Forms
 * ---------------------------------------------------------------------------*/
function add_grav_forms(){
  $role = get_role('editor');
  $role->add_cap('gform_full_access');
}
add_action('admin_init','add_grav_forms');

/*
 * => Nice search queries (not needed if using soil plugin)
 * ---------------------------------------------------------------------------*/

/**
 * Redirects search results from /?s=query to /search/query/, converts %20 to +
 *
 * @link http://txfx.net/wordpress-plugins/nice-search/
 * 
 */
if ( !function_exists('soil_nice_search_redirect') ) {
  function soil_nice_search_redirect() {
    global $wp_rewrite;
    if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->using_permalinks()) {
      return;
    }

    $search_base = $wp_rewrite->search_base;
    if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {
      wp_redirect(home_url("/{$search_base}/" . urlencode(get_query_var('s'))));
      exit();
    }
  }
  add_action('template_redirect', 'soil_nice_search_redirect');
}

/*
 * => Debug
 * --------------------------------------*/
if ( ! function_exists( 'bigwilliam_debug' ) ) {
  function bigwilliam_debug( $message ) {
    if ( WP_DEBUG === true ) {
      if ( is_array( $message ) || is_object( $message ) ) {
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    }
  }
}