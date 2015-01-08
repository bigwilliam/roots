<?php

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


