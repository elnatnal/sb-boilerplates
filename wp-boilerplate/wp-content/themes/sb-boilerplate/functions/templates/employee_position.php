<?php $employee = get_post_meta($post->ID, '_position', true); ?>

<b>Enter the position of this team member:</b>
<input style="margin-top: 5px" type="text" name="_position" value="<?php echo $employee ?>" class="widefat" />