<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>    

<section role="content" class="clearfix">
    
    <div class="vcard">
        <h3><?php the_title(); ?></h3>
        <a class="url fn org" href="http://smashingboxes.com/">smashingboxes.com</a>
        <div class="adr">
            <p>
                <span class="street-address">334 Blackwell Street</span>
                <span class="extended-address">Suite B016</span>
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

    </div>

    <div class="content"><?php the_content() ?></div>

</section>

<?php endwhile;endif ?>

<?php get_footer(); ?>
