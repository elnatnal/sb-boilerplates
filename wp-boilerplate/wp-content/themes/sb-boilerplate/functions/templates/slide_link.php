<?php $link  = get_post_meta($post->ID, '_link', true); ?>

<b>Where should the "go to" button take the user?</b><input style="margin-top: 5px" type="text" name="_link" value="<?php echo $link ?>" class="widefat" />
