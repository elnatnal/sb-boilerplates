<?php

// Helpers
// A set of functions to make development of the site
// easier
// -------------------------------------------------- //

function smashing_get_images($post_id, $size) {

	global $post;

  $count = 0;

	$images = get_children( array(
                                'post_parent' => $post_id, 
                                'post_status' => 'inherit', 
                                'post_type' => 'attachment', 
                                'post_mime_type' => 'image', 
                                'order' => 'DESC', 
                                'orderby' => 'menu_order ID'
                                ) 
                          );

	if ($images) : foreach ($images as $attachment_id => $image) :
    
    $img_title = $image->post_title;
    $img_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
    
    if ($img_alt == '') : $img_alt = $img_title; endif;
    		     
    $src_array = image_downsize( $image->ID, $size );
    $img_url   = $src_array[0];
    $img_class = ( $count === 0) ? "focus" : "";
    
    echo '<img class="'. $img_class . '" src="'. $img_url . '" alt="' . $img_alt. '" title="' . $img_title .'" />';
    
    $count++;

  endforeach; endif;

  return count($images);
}


// Listify Categories
// 
// Turns a group of categories into a list (using commas)
function listify_categories($id) {

  $ret = "";

  foreach((get_the_category($id)) as $category) { 
    $ret = $ret . ", " . $category->cat_name;
  }

  echo substr($ret, 2);
}

?>