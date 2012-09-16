<?php  
     /*
     * Template Name: Portfolio
     *
     */
     ?>

<?php get_header(); ?>

<section role="content">

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <header>
        
        <h1><?php the_title(); ?></h1>

        <div class="toggle">
            <div class="body">
                <p><?php echo get_the_content($post->ID); ?></p>
            </div>
            <a class="toggler">Read more <em>+</em></a>
        </div>

    </header>

		<?php endwhile; endif; ?>

    <?php
         
         $args = array("post_type" => "project", "numberposts" => 9999);
    $projects = get_posts( $args );

    if ($projects) : foreach( $projects as $p ) : 

    setup_postdata($p); 

    $id     = str_replace(" ", "_", strtolower(get_the_title($p->ID)));
    $client = get_post_meta($p->ID, "_client", true);
    $link   = get_post_meta($p->ID, "_link", true);
    $d_name = get_post_meta($p->ID, "_display_name", true);
    ?>

    <article id="<?php echo $id; ?>" class="portfolio-item">

        <figure>
            <?php $count = smashing_get_images($p->ID, "portfolio"); ?>
        </figure>
        
        <section>
            <h3 class="title"><?php echo $client; ?></h3>

            <?php if (strlen(get_the_content($p->ID)) > 440) : ?>

            <div class="toggle">
                <div class="body">
                    <p><?php echo get_the_content($p->ID); ?></p>
                </div>
                <a class="toggler">Read more <em>+</em></a>
            </div>

            <?php else: ?>
            <p class="solo">
                <?php echo get_the_content($p->ID); ?>
            </p>
            <?php endif; ?>

            <h3><?php echo $d_name; ?></h3>

            <a class="link" href="<?php echo $link ?>" target="_blank"><?php echo $link ?></a>

            <ul>
                <?php for($i = 0; $i < $count; $i++) : ?>
                      <li>
                          <a href="#" class="<?php echo ($i === 0) ? 'selected' : '' ?>">
                              <?php echo $i?>
                          </a>
                      </li>
                      <?php endfor; ?>
            </ul>

        </section>

        <footer>
            <button class="scrollback">Back to the top</button>
        </footer>

    </article>

    <?php endforeach; endif; ?>

</section>

<?php get_footer(); ?>
