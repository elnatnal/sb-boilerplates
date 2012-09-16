<?php $dname = get_post_meta($post->ID, '_display_name', true); ?>

<p><b>How do you want the project name to appear on the page?</b></p>

<input type="text" name="_display_name" class="widefat" value="<?php echo $dname ?>" />