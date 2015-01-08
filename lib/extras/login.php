<?php

/*
 * => Custom Login Logo and Links
 * ---------------------------------------------------------------------------*/
function custom_login_logo() { 
  $logo_url = get_template_directory_uri() . '/assets/img/logo.jpg'; ?>
  <style type="text/css">
      body.login div#login h1 a {
        background-image: url(<?php echo $logo_url; ?>);
        background-size: 100%;
        width: 100%;
        height: 185px;
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