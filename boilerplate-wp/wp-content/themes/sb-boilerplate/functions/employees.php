<?php 

// Custom Content Type for Portfolio Items
// -------------------------------------------------- //


function smashingboxes_create_employees() {

  register_post_type( 'employee',
                      array(
                            'labels' => array('name' => __( 'Team Members' ), 'singular_name' => __( 'Employee' )),
                            'description' => 'Profiles for the team section found on the about page',
                            'public' => true,
                            'has_archive' => false,
                            'hierarchical' => false, // set to true to "nest" like pages
                            'menu_position' => 7, // where on the menu it should appear; 5 = below posts, 10 = below media, etc
                            'supports' => array( 'title', 'editor' ),
                            'register_meta_box_cb' => 'add_employee_metaboxes'
                            )
                      );
}

add_action( 'init', 'smashingboxes_create_employees' );

function add_employee_metaboxes() {
  add_meta_box('employee_position', 'Position', 'employee_position', 'employee', 'side', 'default');
}

function employee_position() {
  global $post;

  // instead of writing HTML here, lets run some templates
  echo '<input type="hidden" name="employee_meta_noncename" id="employee_meta_noncename" value="' . wp_create_nonce( plugin_basename(__FILE__) ) .'" />';
	include(FUNCTIONS_DIR . '/functions/templates/employee_position.php');
}

// Save the Metabox Data
 
function save_employee_meta($post_id, $post) {
 
  // Check if data is coming from this 
  if ( !isset($_POST['employee_meta_noncename']) || !wp_verify_nonce( $_POST['employee_meta_noncename'], plugin_basename(__FILE__) )) { 
    return $post->ID; 
  }

  // Is the user allowed to edit the post or page?
  if ( !current_user_can( 'edit_post', $post->ID )) { return $post->ID; }
 
  // OK, we're authenticated: we need to find and save the data
  // We'll put it into an array to make it easier to loop though.
 
  $employee_meta['_position'] = $_POST['_position'];

 
  // Add values of $slide_meta as custom fields
 
  foreach ($employee_meta as $key => $value) {         // Cycle through the $slide_meta array!
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
 
add_action('save_post', 'save_employee_meta', 1, 2);   // save the custom fields

// Custom thumbnail sizes for use with portfolio items
add_image_size( 'profile-pic', 200, 99999 );

?>