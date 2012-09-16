<?php

  // Get the twitter data if its already been entered
  $colorscheme = get_post_meta($post->ID, '_colorscheme', true);

  // Echo out Color Scheme field
  $options = array('normal', 'inverted');

?>

<b>This property will set the color of the text for the slide, useful
    for darker slides</b>

<select style="margin-top: 8px; width: 100%;" name="_colorscheme">'
        <?php
             foreach( $options as $option) {
                 $selected = ($option === $colorscheme) ? "selected" : "";
                 echo '<option ' . $selected  . ' value="' . $option . '">' . ucfirst($option) .'</option>';
             }
        ?>
</select>
