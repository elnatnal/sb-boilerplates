<?php 

// Custom Content Type for Clients
// -------------------------------------------------- //


function smashingboxes_create_clients() {

  register_post_type( 'client',
                      array(
                            'labels' => array('name' => __( 'Clients' ), 'singular_name' => __( 'Client' )),
                            'description' => 'Past clients to display on various parts of the site',
                            'public' => true,
                            'has_archive' => false,
                            'hierarchical' => false, // set to true to "nest" like pages
                            'menu_position' => 8, // where on the menu it should appear; 5 = below posts, 10 = below media, etc
                            'supports' => array( 'title', 'editor', 'thumbnail' )
                            )
                      );
}

add_action( 'init', 'smashingboxes_create_clients' );

// Custom thumbnail sizes for use with portfolio items
add_image_size( 'client-pic', 185, 95 );

?>
