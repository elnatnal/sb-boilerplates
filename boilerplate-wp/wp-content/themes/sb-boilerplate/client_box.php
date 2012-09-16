<?php
     // The Client Box
     // Displays client thumbnails
     ?>

<section class="client_box">

    <?php wp_reset_query(); ?>

    <?php $args = array("numberposts" => 5,  "post_type" => "client" ); $clients = get_posts( $args );

    foreach( $clients as $client ) :	setup_postdata($client); ?>

    <div class="client">
        <?php echo get_the_post_thumbnail($client->ID, "client-pic") ?>
    </div>

    <?php endforeach; ?>

</section>
