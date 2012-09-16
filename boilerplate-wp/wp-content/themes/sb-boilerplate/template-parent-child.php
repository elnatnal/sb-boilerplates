<?php
     // Template Name: Parent-Child
     // -------------------------------------------------- //

     get_header();
     setup_postdata($post);
     ?>

<section role="content" class="clearfix">

    <article class="child">
        <header>
            <h2><?php the_title(); ?></h2>
        </header>
        
        <nav>
            <?php wp_nav_menu("container=nav&menu='" . $posts[0]->post_name . "'"); ?>
        </nav>
        
        <div class="entry">
            <?php the_content(); ?>
        </div>

        <?php $pages = get_pages(array( "child_of" => $post->ID, "sort_column" => "menu_order")); ?>
        
    </article>

    <?php if($pages) : foreach($pages as $child) : setup_postdata($child);  ?>

    <article class="child">

        <header>
            <h2><?php echo get_the_title($child->ID); ?></h2>
        </header>

        <nav>
            <?php wp_nav_menu("container=nav&menu='" . $posts[0]->post_name . "'"); ?>
        </nav>

        <div class="entry">
            <?php the_content($child->ID); ?>
        </div>

    </article>

    <?php endforeach; endif; ?>

</section>

<?php get_footer(); ?>
