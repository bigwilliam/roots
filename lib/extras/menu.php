<?php

/*
 * => Hide certain menu items
 * ---------------------------------------------------------------------------*/

function remove_menu_items() {
  // provide a list of usernames who can access special admin menu items
  $admins = array( 
    'bigwilliam',
    'cobbman'
  );

  // get the current user
  $current_user = wp_get_current_user();

  // match and remove if needed
  if( !in_array( $current_user->user_login, $admins ) ) {
    remove_menu_page('edit.php?post_type=acf-field-group'); // Remove ACF Menu
    remove_menu_page('acf-options'); // Remove ACF Options
    remove_menu_page('wptouch-admin-touchboard'); // WP Touch Mobile Theme Plugin
  }
}

// add_action( 'admin_menu', 'remove_menu_items', 999 );

/*
 * => Change posts to 'blog'
 * ---------------------------------------------------------------------------*/

function custom_menu_names() {
  global $menu;
  $menu[5][0] = 'Blog';
}
add_action( 'admin_menu', 'custom_menu_names', 999 );

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
  //   'page_title'  => 'Theme General Settings',
  //   'menu_title'  => 'Theme Settings',
  //   'parent_slug' => 'themes.php',
  // ));
  
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
    'id'     => 'bigwilliam-link',
    'title'  => __( 'BigWilliam', 'roots' ),
    'href'   => 'http://bigwilliam.com'
  ) );

  // Add support link
  $wp_admin_bar->add_menu( array(
    'parent' => 'wp-logo',
    'id'     => 'bigwilliam-contact',
    'title'  => __( 'Contact BigWilliam', 'roots' ),
    'href'   => 'http://bigwilliam.com/contact'
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
     'http://bigwilliam.com/',
     __( 'BigWilliam', 'roots' ) 
  );
}
add_filter( 'admin_footer_text', 'replace_footer_text' );