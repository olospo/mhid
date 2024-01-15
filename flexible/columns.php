<div class="flexible two_columns">
<?php if( have_rows('left_column') ): ?>
  <?php while( have_rows('left_column') ): the_row(); 
    // Get sub field values.
      $type = get_sub_field('left_text_or_image');
      $title = get_sub_field('left_title');
      $content = get_sub_field('left_content');
      $buttonText = get_sub_field('left_button_text');
      $buttonLink = get_sub_field('left_button_link');
      $image = get_sub_field('left_image');
      
        $size = 'featured-img';
        $thumb = $image['sizes'][ $size ];
      ?>
    
      <?php if( $type == 'image') { ?>
      <div class="image six columns">
        <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
      </div>
      <?php } ?>
      
      <?php if( $type == 'text') { ?>
      <div class="content six columns">
        <h3><?php echo $title; ?></h3>
        <?php echo $content; ?>
        <?php if( $buttonText ): ?>
          <a href="<?php echo $buttonLink; ?>" class="button primary"><?php echo $buttonText; ?></a>
        <?php endif; ?>
      </div>
      <?php } ?>
      
  <?php endwhile; ?>
<?php endif; ?>

<?php if( have_rows('right_column') ): ?>
  <?php while( have_rows('right_column') ): the_row(); 
    // Get sub field values.
      $type = get_sub_field('right_text_or_image');
      $title = get_sub_field('right_title');
      $content = get_sub_field('right_content');
      $buttonText = get_sub_field('right_button_text');
      $buttonLink = get_sub_field('right_button_link');
      $image = get_sub_field('right_image');
      
      $size = 'featured-img';
      $thumb = $image['sizes'][ $size ];
      ?>
    
      <?php if( $type == 'image') { ?>
      <div class="image six columns">
        <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
      </div>
      <?php } ?>
      
      <?php if( $type == 'text') { ?>
      <div class="content six columns">
        <h3><?php echo $title; ?></h3>
        <?php echo $content; ?>
        <?php if( $buttonText ): ?>
          <a href="<?php echo $buttonLink; ?>" class="button primary"><?php echo $buttonText; ?></a>
        <?php endif; ?>
      </div>
      <?php } ?>
      
  <?php endwhile; ?>
<?php endif; ?>

</div>