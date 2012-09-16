<?php
     /*
     * Template Name: Home
     */

     get_header(); 
?>

<?php get_template_part('slider'); ?>

<section role="content" class="clearfix">

  <section class="callout">
      <blockquote>
          <?php wp_reset_query(); ?>
          <?php echo get_the_content($post->ID); ?>
      </blockquote>
  </section>

    
    <?php global $post; $args = array( 'numberposts' => 4 ); $myposts = get_posts( $args );
    
    foreach( $myposts as $post ) :	setup_postdata($post); ?>
    
    <article <?php post_class() ?> id="post-<?php the_ID(); ?>">
        
        <p class="meta"><?php listify_categories($post->ID) ?></p>

        <h2><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h2>

        <footer>
            <p class="author">by <strong><?php echo the_author_firstname(); ?> <?php the_author_lastname(); ?></strong></p>
        </footer>

    </article>
    
    <?php endforeach; ?>

</section>

<hr />

<img class="home-clients" src="<?php bloginfo('template_directory')?>/images/clients.jpg" alt="Our clients" />


<?php get_footer(); ?>
