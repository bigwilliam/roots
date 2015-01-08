<?php

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

