<?php
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