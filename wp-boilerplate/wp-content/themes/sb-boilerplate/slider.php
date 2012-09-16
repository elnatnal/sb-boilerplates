<?php 
     # The SmashingBoxes Slider
     # Found on the homepage
?>

<section id="smashing_slider">
    
    <section class="slide" data-class="intro">
        <header>
            <h2>We Design <br/>&amp; Develop Custom <br/> Applications</h2>
        </header>
        <div class="feature">
            <img src="<?php bloginfo("template_directory"); ?>/images/banners/home_feature.jpg" />
            <a class="iLightbox" href="http://player.vimeo.com/video/32873116?title=0&amp;byline=0&amp;portrait=0"></a>
        </div>
    </section>

    <?php 
    $args = array("post_type" => "slide" );
    $slides = get_posts( $args );

    if ($slides) : foreach( $slides as $slide ) : ?>

    <?php 
         $inverted = (get_post_meta($slide->ID, "_colorscheme", true) === "inverted") ? "true": "false"; 
         $class    = get_post_meta($slide->ID, "_class", true);
         $link     = get_post_meta($slide->ID, "_link", true);
    ?>

    <section class="slide" data-class="<?php echo $class; ?>" data-inverted="<?php echo $inverted; ?>">
        <header>
            <h2> <?php echo get_the_title($slide->ID); ?> </h2>
            <?php $post = get_page($slide->ID); $content = apply_filters('the_content', $post->post_content); echo $content;  ?>
        </header>
        <div class="feature">
            <a href="<?php echo $link ?>">
                <?php echo get_the_post_thumbnail( $slide->ID ); ?>
            </a>
        </div>
    </section>  

    <?php endforeach; endif; ?>

</section>
