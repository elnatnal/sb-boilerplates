<ul class="teammates">
    
    <?php
         
    global $post;
    $args = array("post_type" => "employee", "numberposts" => 100);
    $team = get_posts( $args );
    $count = 0;
    
    foreach( $team as $mate ) :	setup_postdata($mate); 

    $count++;

    $name = get_the_title($mate->ID);
    $job  = get_post_meta($mate->ID, "_position", true);
    $bio  = get_the_content($mate->ID);
    $pic  = get_the_post_thumbnail($mate->ID, "profile-pic");
    $class = "";
    
    if ($count % 4 === 0 && $count !== 0) {
        $class = $class . " last";
    }

    ?>

    <li class="<?php echo $class; ?>">

        <div class="thumb">
            <?php smashing_get_images($mate->ID, "profile-pic"); ?>
        </div>

        <h2><?php echo $name; ?></h2>
        <h3><?php echo $job; ?></h3>

        <div class="entry">
            <?php echo $bio; ?>
        </div>
    </li>
    
    <?php endforeach; ?>

</ul>
