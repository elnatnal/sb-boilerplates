<footer id="footer" class="clearfix source-org vcard copyright">

    <ul class="footer-social">
        <li>
            <a href="https://www.facebook.com/smashingboxes" class="url">
                <img src="<?php bloginfo("template_directory") ?>/images/icons/pink/small_facebook.png" />
            </a>
        </li>
        <li>
            <a href="https://twitter.com/#!/smashingboxes" class="url">
                <img src="<?php bloginfo("template_directory") ?>/images/icons/pink/small_twitter.png" />
            </a>
        </li>
        <li>
            <a href="http://youtube.com/smashingboxesvideos" class="url">
                <img src="<?php bloginfo("template_directory") ?>/images/icons/pink/small_youtube.png" />
            </a>
        </li>
        <li>
            <a href="http://vimeo.com/smashingboxes" class="url">
                <img src="<?php bloginfo("template_directory") ?>/images/icons/pink/small_vimeo.png" />
            </a>
        </li>
    </ul>

    <?php wp_nav_menu( array('class' => 'footer-nav', 'menu' => 'Footer Nav', 'container' => '' )) ?>

</footer>

</div>

<?php wp_footer(); ?>

<script src="<?php bloginfo('template_directory'); ?>/js/min.js"></script>

<script type="text/javascript">
    
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-29292622-1']);
    _gaq.push(['_trackPageview']);
    
    (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
    
</script>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=233564906746202";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
</body>

</html>
