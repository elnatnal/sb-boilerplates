<aside id="sidebar">

    <?php if (function_exists('dynamic_sidebar') && dynamic_sidebar('Sidebar Widgets')) : else : ?>
    
    <!-- All this stuff in here only shows up if you DON'T have any widgets active in this zone -->

    <?php get_search_form(); ?>
    
    <h3>Archives</h3>

    <ul>
    		<?php wp_get_archives('type=monthly'); ?>
    </ul>
    
    <h3>Categories</h3>
    <ul>
    	  <?php wp_list_categories('show_count=1&title_li='); ?>
    </ul>
    
    <h3>Meta</h3>
    <ul>
    		<?php wp_register(); ?>
    		<li><?php wp_loginout(); ?></li>
    		<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
    		<?php wp_meta(); ?>
    </ul>
    
	  <?php endif; ?>
    
    <div class="sidebar-social">
        <a class="facebook" href="https://www.facebook.com/smashingboxes" class="url">
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
    
</aside>
