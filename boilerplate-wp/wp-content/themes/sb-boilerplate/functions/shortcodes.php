<?php

function the_team_shortcode($atts) {
  $data = get_template_part('functions/templates/team');

  return $data;
}


function the_clients_shortcode($atts) {

  global $post;
  wp_reset_query();

  // Start the section
  $html = '<section class="client_box">';

  $args = array("numberposts" => 15,  "post_type" => "client" ); 
  $clients = get_posts( $args );
  $count = 0;

  // Add the clients
  foreach( $clients as $client ){
    
    
    $html = $html . '<div class="client' . (($count % 5 === 0) ? " first" : "") .'">';
    $html = $html . get_the_post_thumbnail($client->ID);
    $html = $html . '</div>';

    $count++;

  }

  // End the section
  $html = $html . '</section>';

  return $html;

}


add_shortcode('the_team', 'the_team_shortcode');
add_shortcode('the_clients', 'the_clients_shortcode');

?>
