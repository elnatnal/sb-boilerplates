<?php
     /*
     * Template Name: Contact
     */

     get_header();
?>

<section role="content" class="clearfix">
    
    <div id="smashing_map"></div>

    <div class="vcard">
        <h3>Let's Talk About Your Project</h3>
        <h4>Contact Info</h4>

        <a class="url fn org" href="http://smashingboxes.com/">smashingboxes.com</a>
        <div class="adr">
            <p>
                <span class="street-address">334 Blackwell Street</span>
                <span class="extended-address">Suite B017</span>
            </p>
            <p>
                <span class="locality">Durham</span>,
                <span class="region">NC</span>
                <span class="postal-code">27701</span>
            </p>
        </div>

        <div class="tel">
            <span class="type">work</span>
            <span class="value">1-855-762-7446</span>
        </div>

        <div class="social">
            <a href="https://www.facebook.com/smashingboxes" class="url">
                <img src="<?php bloginfo("template_directory") ?>/images/icons/pink/facebook.png" />
            </a>
            <a href="https://twitter.com/#!/smashingboxes" class="url">
                <img src="<?php bloginfo("template_directory") ?>/images/icons/pink/twitter.png" />
            </a>
            <a href="http://youtube.com/smashingboxesvideos" class="url">
                <img src="<?php bloginfo("template_directory") ?>/images/icons/pink/youtube.png" />
            </a>
            <a href="http://vimeo.com/smashingboxes" class="url">
                <img src="<?php bloginfo("template_directory") ?>/images/icons/pink/vimeo.png" />
            </a>
        </div>

    </div>
    

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content() ?>
    <?php endwhile;endif ?>
</section>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>

<?php get_footer(); ?>
