<?php $selected = get_post_meta($post->ID, '_client', true); ?>

<p><b>What client was this project for?</b></p>

<select style="margin-top: 5px" type="text" name="_client" class="widefat" />

<?php wp_reset_query(); ?>

<?php $args = array("numberposts" => 100,  "post_type" => "client" ); $clients = get_posts( $args );

foreach( $clients as $client ) :	setup_postdata($client); ?>
<?php
     $name = get_the_title($client->ID);
     
     if ($name == $selected ) : ?>
         <option selected value="<?php echo $name ?>"><?php echo $name ?></option>
     <?php else: ?>
         <option value="<?php echo $name ?>"><?php echo $name ?></option>
     <?php endif; ?>

<?php endforeach; ?>

</select>
