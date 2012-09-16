<?php $link = get_post_meta($post->ID, '_link', true); ?>

<p>
    <b>Where will the project&rsquo;s external link take the user?</b>
</p>
<em> (remember to use http://)</em>

<input style="margin-top: 5px" type="text" name="_link" value="<?php echo $link ?>" class="widefat" />
