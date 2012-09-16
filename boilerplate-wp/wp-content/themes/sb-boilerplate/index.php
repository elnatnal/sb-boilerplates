<?php get_header(); ?>

<section role="content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">

        <p class="meta"><?php listify_categories($post->ID) ?></p>

        <time>
            <?php the_date("m/d/y"); ?>
        </time>

        <h2 class="title"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2> 
        <?php include (TEMPLATEPATH . '/_/inc/meta.php' ); ?>
        <div class="content">
            <?php the_post_thumbnail("blog-feature") ?>
            <?php the_excerpt(); ?> 
        </div>

        <footer>
             <p>
                <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php echo the_permalink() ?>" data-text="<?php the_title() ?>" data-via="smashingboxes" data-count="none">Tweet</a>
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>

                | 
                
                <g:plusone href="<?php echo the_permalink() ?>" size="medium" count="false"></g:plusone> 
                
                | 

                <?php echo do_shortcode('[fb_like]');?>

                
                <?php comments_popup_link('No Comments', '1 Comment', '% Comments', 'comments-link', ''); ?>
            </p>
        </footer>

    </article>

    <?php endwhile; ?>

    <?php else : ?>

    <h2>Not Found</h2>

    <?php endif; ?>

    
    <div class="navigation">
	      <div class="next-posts"><?php next_posts_link('&laquo; Older Entries') ?></div>
	      <div class="prev-posts"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
    </div>
    

</section>

<?php get_sidebar(); ?>

<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>

<?php get_footer(); ?>
