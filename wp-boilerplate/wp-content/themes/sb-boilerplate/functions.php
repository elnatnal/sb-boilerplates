<?php

//--------------------------------------------------//
// Smashingboxes Wordpress Theme Functions
//--------------------------------------------------//
// Author: Nate Hunzaker <nate@smashingboxes.com>
//--------------------------------------------------//
//
// What's in here:
//
// 1. General Theme Setup
// 2. Sidebars
// 3. Custom Content Types
//
//--------------------------------------------------//

define('FUNCTIONS_DIR',str_replace("\\",'/',dirname(__FILE__)));

// 1. General Theme Setup
//--------------------------------------------------//

// Translations can be filed in the /languages/ directory
load_theme_textdomain( 'html5reset', TEMPLATEPATH . '/languages' );

$locale = get_locale();
$locale_file = TEMPLATEPATH . "/languages/$locale.php";
if ( is_readable($locale_file) )
  require_once($locale_file);

// Add RSS links to <head> section
add_theme_support("automatic-feed-links");

// Clean up the <head>
function setup() {
  remove_action('wp_head', 'rsd_link');
  remove_action('wp_head', 'wlwmanifest_link');

  // Load jQuery
  if ( !is_admin() ) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', ("https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"), false);
    wp_enqueue_script('jquery');
  }

}

add_action('init', 'setup');
remove_action('wp_head', 'wp_generator');

add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'audio', 'chat', 'video'));
add_theme_support( 'post-thumbnails' ); 

require_once("functions/shortcodes.php");

// Puts link in excerpts more tag
function new_excerpt_more($more) {
       global $post;
	return '...<a class="moretag" href="'. get_permalink($post->ID) . '">Read the full article</a>';
}
add_filter('excerpt_more', 'new_excerpt_more');

// 2. Sidebars
//--------------------------------------------------//

if (function_exists('register_sidebar')) {

  register_sidebar(array(
                         'name' => __('Sidebar Widgets','html5reset' ),
                         'id'   => 'sidebar-widgets',
                         'description'   => __( 'These are widgets for the sidebar.','html5reset' ),
                         'before_widget' => '<div id="%1$s" class="widget %2$s">',
                         'after_widget'  => '</div>',
                         'before_title'  => '<h2>',
                         'after_title'   => '</h2>'
                         ));
}



// 3. Custom Content Types
//--------------------------------------------------//

// Custom Content Type for Team Mates
require_once('functions/slides.php');
require_once('functions/portfolio.php');
require_once('functions/clients.php');
require_once('functions/employees.php');


// 4. Helper Functions
//--------------------------------------------------//
require_once("functions/helpers.php");

// Custom thumbnail sizes for use with blog featured images
add_image_size( "blog-feature", 150, 150 );

?>
