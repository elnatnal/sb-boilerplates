<?php 

// Custom Content Type for Portfolio Items
// -------------------------------------------------- //


function smashingboxes_create_portfolio() {

  register_post_type( 'project',
                      array(
                            'labels' => array('name' => __( 'Portfolio' ), 'singular_name' => __( 'Project' )),
                            'description' => 'Works for the portfolio page',
                            'public' => true,
                            'has_archive' => false,
                            'hierarchical' => false, // set to true to "nest" like pages
                            'menu_position' => 7, // where on the menu it should appear; 5 = below posts, 10 = below media, etc
                            'supports' => array( 'title', 'editor', 'thumbnail' ),
                            'register_meta_box_cb' => 'add_project_metaboxes'

                            )
                      );
}

function add_project_metaboxes() {
  add_meta_box('project_display_name', 'Display Name'  , 'project_display_name', 'project', 'side', 'default');
  add_meta_box('project_link'        , 'External Link' , 'project_link'        , 'project', 'side', 'default');
  add_meta_box('project_client'      , 'Client'        , 'project_client'      , 'project', 'side', 'default');
}

function project_link() {
  global $post;
  echo '<input type="hidden" name="project_meta_noncename" id="project_meta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) .'" />';
	include(FUNCTIONS_DIR . '/functions/templates/project_link.php');
}

function project_client() {
  global $post;
  echo '<input type="hidden" name="project_meta_noncename" id="project_meta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) .'" />';
  include(FUNCTIONS_DIR . '/functions/templates/project_client.php');
}

function project_display_name() {
  global $post;
  echo '<input type="hidden" name="project_meta_noncename" id="project_meta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) .'" />';
  include(FUNCTIONS_DIR . '/functions/templates/project_display_name.php');
}


function save_project_meta($post_id, $post) {
 
  // Check if data is coming from this 
  if ( !isset($_POST['project_meta_noncename']) || !wp_verify_nonce( $_POST['project_meta_noncename'], plugin_basename(__FILE__) )) { 
    return $post->ID; 
  }

  // Is the user allowed to edit the post or page?
  if ( !current_user_can( 'edit_post', $post->ID )) { return $post->ID; }
 
  // OK, we're authenticated: we need to find and save the data
  // We'll put it into an array to make it easier to loop though.
 
  $project_meta['_link'] = $_POST['_link'];
  $project_meta['_client'] = $_POST['_client'];
  $project_meta['_display_name'] = $_POST['_display_name'];
 
  // Add values of $project_meta as custom fields
 
  foreach ($project_meta as $key => $value) {         // Cycle through the $project_meta array!
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
 
add_action('save_post', 'save_project_meta', 1, 2);   // save the custom fields
add_action( 'init', 'smashingboxes_create_portfolio' );

// Custom thumbnail sizes for use with portfolio items
add_image_size( 'portfolio', 500, 9999 );

?>