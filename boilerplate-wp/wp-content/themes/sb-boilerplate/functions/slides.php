<?php 


// Custom Content Type for mentors
add_action( 'init', 'smashingboxes_create_slide' );

function smashingboxes_create_slide() {
  register_post_type( 'slide',
                      array(
                            'labels' => array('name' => __( 'Slideshow' ), 'singular_name' => __( 'Slide' )),
                            'description' => 'Slides for the homepage',
                            'public' => true,
                            'has_archive' => false,
                            'hierarchical' => false, // set to true to "nest" like pages
                            'menu_position' => 6,    // where on the menu it should appear; 5 = below posts, 10 = below media, etc
                            'supports' => array( 'title', 'editor', 'thumbnail' ),
                            'register_meta_box_cb' => 'add_slide_metaboxes'
                            )
                      );
}

function add_slide_metaboxes() {
  add_meta_box('slide_link', 'Link', 'slide_link', 'slide', 'side', 'default');
  add_meta_box('slide_class', 'Class', 'slide_class', 'slide', 'side', 'default');
  add_meta_box('slide_colorscheme', 'Color Scheme', 'slide_colorscheme', 'slide', 'side', 'default');
}

function getSlideNouncename() {
  
  return '<input type="hidden" name="slide_meta_noncename" id="slide_meta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) .'" />';

}
 
function slide_class() {
  global $post;

  // instead of writing HTML here, lets run some templates
  echo getSlideNouncename();
	include(FUNCTIONS_DIR . '/functions/templates/slide_class.php');
}
 
function slide_colorscheme() {
  global $post;

  // instead of writing HTML here, lets run some templates
  echo getSlideNouncename();
	include(FUNCTIONS_DIR . '/functions/templates/slide_colorscheme.php');
  
}

function slide_link() {
  global $post;

  // instead of writing HTML here, lets run some templates
  echo getSlideNouncename();
	include(FUNCTIONS_DIR . '/functions/templates/slide_link.php');
  
}


// Save the Metabox Data
 
function save_slide_meta($post_id, $post) {
 
  // Check if data is coming from this 
  if ( !isset($_POST['slide_meta_noncename']) || !wp_verify_nonce( $_POST['slide_meta_noncename'], plugin_basename(__FILE__) )) { 
    return $post->ID; 
  }

  // Is the user allowed to edit the post or page?
  if ( !current_user_can( 'edit_post', $post->ID )) { return $post->ID; }
 
  // OK, we're authenticated: we need to find and save the data
  // We'll put it into an array to make it easier to loop though.
 
  $slide_meta['_class'] = $_POST['_class'];
  $slide_meta['_colorscheme'] = $_POST['_colorscheme'];
  $slide_meta['_link'] = $_POST['_link'];

 
  // Add values of $slide_meta as custom fields
 
  foreach ($slide_meta as $key => $value) {         // Cycle through the $slide_meta array!
    if( $post->post_type == 'revision' ) return;    // Don't store custom data twice

    $value = implode(',', (array)$value);           // If $value is an array, make it a CSV (unlikely)
    
    if(get_post_meta($post->ID, $key, FALSE)) {     // If the custom field already has a value
      update_post_meta($post->ID, $key, $value);
    } else {                                        // If the custom field doesn't have a value
      add_post_meta($post->ID, $key, $value);
    }
    if(!$value) delete_post_meta($post->ID, $key);  // Delete if blank
  }
 
}
 
add_action('save_post', 'save_slide_meta', 1, 2);   // save the custom fields

?>