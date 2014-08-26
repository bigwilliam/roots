<?php
/**
 * Roots includes
 *
 * The $roots_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/roots/pull/1042
 */
$roots_includes = array(
  'lib/utils.php',           // Utility functions
  'lib/init.php',            // Initial theme setup and constants
  'lib/wrapper.php',         // Theme wrapper class
  'lib/sidebar.php',         // Sidebar class
  'lib/config.php',          // Configuration
  'lib/activation.php',      // Theme activation
  'lib/titles.php',          // Page titles
  'lib/nav.php',             // Custom nav modifications
  'lib/gallery.php',         // Custom [gallery] modifications
  'lib/comments.php',        // Custom comments modifications
  'lib/scripts.php',         // Scripts and stylesheets
  'lib/extras.php',          // Custom functions
);

foreach ($roots_includes as $file) {
  if (!$filepath = locate_template($file)) {
    trigger_error(sprintf(__('Error locating %s for inclusion', 'roots'), $file), E_USER_ERROR);
  }

  require_once $filepath;
}
unset($file, $filepath);



/*========================================================================*
  Some Custom Stuff 
 *========================================================================*/


/*
 * => ACF color picker custom color
 * ---------------------------------------------------------------------------*/
function load_javascript_on_admin_edit_post_page() {
  global $parent_file;

  // If we're on the edit post page.
  if (
    strpos($parent_file, 'post-new.php') !== FALSE ||
    strpos($parent_file, 'edit.php') !== FALSE ||
    strpos($parent_file, 'post.php') !== FALSE
  ) {
    echo "
      <script>
      jQuery(document).ready(function($){
        if ($('.acf-color_picker').length) {
          $('.acf-color_picker').iris({
            palettes: ['#2b1d17', '#796a5e', '#928b85', '#e5cbb5', '#eeebe9', '#417991'],
            change: function(event, ui){
            //$(this).parents('.wp-picker-container').find('.wp-color-result').css('background-color', ui.color.toString());
            }
          });
        }
      });
      </script>
    ";
  }
}
// add_action('in_admin_footer', 'load_javascript_on_admin_edit_post_page');


/*
 * => ACF Options Pages
 * ----------------------------------------------------------------*/
if( function_exists('acf_add_options_page') ) {
  
  acf_add_options_page(array(
    'page_title'  => 'Theme General Settings',
    'menu_title'  => 'Theme Settings',
    'menu_slug'   => 'theme-general-settings',
    'capability'  => 'edit_posts',
    'redirect'    => false
  ));
  
  // acf_add_options_sub_page(array(
  //   'page_title'  => 'Theme Header Settings',
  //   'menu_title'  => 'Header',
  //   'parent_slug' => 'theme-general-settings',
  // ));
  
  // acf_add_options_sub_page(array(
  //   'page_title'  => 'Theme Footer Settings',
  //   'menu_title'  => 'Footer',
  //   'parent_slug' => 'theme-general-settings',
  // ));
  
}


/*
 * => TinyMCE Customizations
 * ---------------------------------------------------------------------------*/
/*
 * => Custom TinyMCE Buttons, styles and formats
 * ---------------------------------------------------------------------------*/

// add new buttons
function customtinymce_register_buttons($buttons) {
  array_push($buttons, 'separator', 'specialHeadings');
  // array_push($buttons, 'separator', 'pajaroLightbox');
  return $buttons;
}
// add_filter('mce_buttons', 'customtinymce_register_buttons');
 
// Load the TinyMCE plugin : editor_plugin.js (wp2.5)
function customtinymce_register_tinymce_javascript($plugin_array) {
   $plugin_array['customtinymce'] = get_template_directory_uri() . '/assets/js/tinymce/customtinymce.js';
   // $plugin_array['mylayout'] = get_template_directory_uri() . '/assets/js/tinymce/customtinymce.js';
   return $plugin_array;
}
// add_filter('mce_external_plugins', 'customtinymce_register_tinymce_javascript');




// other stuff
function pajaro_mce_buttons_2($buttons) {
  array_unshift($buttons, 'styleselect');
  array_splice($buttons, 4, 0, 'backcolor');

//  $remove = array('redo','undo','outdent','indent');
//  $buttons = array_diff($buttons,$remove);

  return $buttons;
}
// add_filter('mce_buttons_2', 'pajaro_mce_buttons_2');

function mce_before_init_insert_formats($init_array) {
  // custom style formats
  $style_formats = array(

    array(
      'title' => 'Anchor Text (caps)',
      'classes' => 'anchor-caps',
      'block' => 'div'
    ),

    array(
      'title' => 'Sans Serif Font',
      'classes' => 'sans-serif-font',
      'inline' => 'span'
    ),

    array(
      'title' => 'Abraham Font',
      'classes' => 'abraham-font',
      'selector' => 'p, a, span, strong, b, em'
    )

  );
  $init_array['style_formats'] = json_encode($style_formats);

  // custom colors
  // $custom_colours ='
  //   "3D1950", "pajaro Purple",
  //   "c792e2", "pajaro Pink",
  //   "000000", "pajaro Black",
  //   "3b3735", "pajaro Dark Gray",
  //   "666966", "pajaro Medium Gray",
  //   "e4e4e4", "pajaro Light Gray",
  //   "ffffff", "pajaro White",
  //   "ddceb9", "pajaro Tan",
  //   "6e5c51", "pajaro Brown",
  //   "511919", "Red",
  //   "191E51", "Blue",
  //   "195122", "Green",
  // ';
  // $init_array['textcolor_map'] = '['.$custom_colours.']';
  // $init_array['textcolor_cols'] = 6;

  return $init_array;
}
// add_filter('tiny_mce_before_init', 'mce_before_init_insert_formats');



/*
 * => Custom Admin Columns !
 * ---------------------------------------------------------------------------*/

/* ALL POST TYPES: posts AND custom post types */
// add_filter('manage_posts_columns', 'CUSTOM_columns_head');
// add_action('manage_posts_custom_column', 'CUSTOM_columns_content', 10, 2);

/* ONLY WORDPRESS DEFAULT POSTS */
// add_filter('manage_post_posts_columns', 'CUSTOM_columns_head', 10);
// add_action('manage_post_posts_custom_column', 'CUSTOM_columns_content', 10, 2);

/* ONLY WORDPRESS DEFAULT PAGES */
// add_filter('manage_page_posts_columns', 'CUSTOM_columns_head', 10);
// add_action('manage_page_posts_custom_column', 'CUSTOM_columns_content', 10, 2);

/* ONLY CUSTOM POST TYPES ( change POSTTYPE to match the correct name) */
// add_filter('manage_POSTTYPE_posts_columns', 'CUSTOM_columns_head', 10);
// add_action('manage_POSTTYPE_posts_custom_column', 'CUSTOM_columns_content', 10, 2);

/* CREATE TWO FUNCTIONS TO HANDLE THE COLUMN */
function CUSTOM_columns_head($defaults) {
  $defaults['author_photo'] = 'Author Photo';
  $defaults['another_custom'] = 'Another one';
  return $defaults;
}
function CUSTOM_columns_content($column_name, $post_ID) {
  if ($column_name == 'author_photo') {
    if ( $photo = get_field('author_photo', $post_ID) ) { ?>
      <img src="<?= $photo['url'] ?>" style="width:60px;height:60px;" />
    <?php } else { ?>
      <img src="http://placehold.it/60&text=no+image" /><?php
    }
  }

  if ($column_name == 'another_custom') {
    echo "content here";
  }
}


/*
 * => Debug Function
 * ---------------------------------------------------------------------------*/

if ( ! function_exists( 'skyhook_debug' ) ) {
  function skyhook_debug( $message ) {
    if ( WP_DEBUG === true ) {
      if ( is_array( $message ) || is_object( $message ) ) {
        error_log( print_r( $message, true ) );
      } else {
        error_log( $message );
      }
    }
  }
}


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
 * => Custom Login Logo and Links
 * ---------------------------------------------------------------------------*/
function custom_login_logo() { 
  $logo_url = "http://placehold.it/140x100&text=Custom+Logo"; ?>
  <style type="text/css">
      body.login div#login h1 a {
        background-image: url(<?php echo $logo_url; ?>);
        background-size: 100%;
        width: 145px;
      }
      .login form .input, .login input[type="text"] {
        background: #fff;
      }
  </style>
<?php 
} 
add_action( 'login_enqueue_scripts', 'custom_login_logo' );

// Add logo link
function my_login_logo_url() {
    return get_bloginfo( 'url' );
} add_filter( 'login_headerurl', 'my_login_logo_url' );

// Add logo link title
function my_login_logo_url_title() {
    return get_bloginfo( 'name' );
} add_filter( 'login_headertitle', 'my_login_logo_url_title' );


/*
 * => Hide certain menu items
 * ---------------------------------------------------------------------------*/

function remove_menu_items() {
  // provide a list of usernames who can access special admin menu items
  $admins = array( 
    'skyhook',
    'bigwilliam',
    'cobbman'
  );

  // get the current user
  $current_user = wp_get_current_user();

  // match and remove if needed
  if( !in_array( $current_user->user_login, $admins ) ) {
    remove_menu_page('edit.php?post_type=acf'); // Remove ACF Menu
    remove_menu_page('acf-options'); // Remove ACF Options
    remove_menu_page('wptouch-admin-touchboard'); // WP Touch Mobile Theme Plugin
  }
}
add_action( 'admin_menu', 'remove_menu_items', 999 );


/*
 * => Change posts to 'blog'
 * ---------------------------------------------------------------------------*/

function custom_menu_names() {
  global $menu;
  $menu[5][0] = 'Blog';
}
add_action( 'admin_menu', 'custom_menu_names', 999 );


/*
 * => Change Admin bar
 * ---------------------------------------------------------------------------*/

function change_admin_bar() {

  // Global
  global $wp_admin_bar;

  // Remove Links
  $wp_admin_bar->remove_menu( 'new-link'        );
  $wp_admin_bar->remove_menu( 'new-media'       );
  $wp_admin_bar->remove_menu( 'new-user'        );
  $wp_admin_bar->remove_menu( 'comments'        );
  $wp_admin_bar->remove_menu( 'about'           );
  $wp_admin_bar->remove_menu( 'wporg'           );
  $wp_admin_bar->remove_menu( 'documentation'   );
  $wp_admin_bar->remove_menu( 'support-forums'  );
  $wp_admin_bar->remove_menu( 'feedback'        );

  // Add site link
  $wp_admin_bar->add_menu( array(
    'parent' => 'wp-logo',
    'id'     => 'Skyhook Marketing-site',
    'title'  => __( 'Skyhook Marketing', 'roots' ),
    'href'   => 'http://Skyhook Marketing.com'
  ) );

  // Add support link
  $wp_admin_bar->add_menu( array(
    'parent' => 'wp-logo',
    'id'     => 'Skyhook Marketing-support',
    'title'  => __( 'Skyhook Marketing Support', 'roots' ),
    'href'   => 'http://SkyhookMarketing.com/contact'
  ) );
}
add_action( 'wp_before_admin_bar_render', 'change_admin_bar' );


/*
 * => Replace Footer text
 * ---------------------------------------------------------------------------*/

function replace_footer_text () {
  printf( 
    '<span id="footer-thankyou">%s <a href="%s" target="_blank">%s</a>.</span>',
     __( 'Website proudly created by', 'roots' ), 
     'http://SkyhookMarketing.com/',
     __( 'Skyhook Marketing', 'roots' ) 
  );
}
add_filter( 'admin_footer_text', 'replace_footer_text' );


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

