<?php
/**
 * Extras includes: customizations for this theme
 *
 * The $extras_includes array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 *
 * Please note that missing files will produce a fatal error.
 *
 * @link https://github.com/roots/roots/pull/1042
 */
$extras_includes = array(
  'extras/cleanup.php',              // Utilities n' stuff
  'extras/acf.php',                  // ACF custom items
  'extras/menu.php',                 // Changes to the admin menu, bar and footer
  'extras/tinymce.php',              // TinyMCE customizations
  'extras/admin_columns.php',        // Admin columns
  'extras/login.php',                 // Custom login logo and links

  /* Custom Post Types */
  'extras/posttypes/trainings.php'   // Trainings Post Type
);

foreach ($extras_includes as $file) {
  // if (!$filepath = locate_template($file)) {
  //   trigger_error(sprintf(__('Error locating %s for inclusion', 'roots'), $file), E_USER_ERROR);
  // }

  require_once $filepath;
}
// unset($file, $filepath);


