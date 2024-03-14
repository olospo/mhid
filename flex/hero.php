<?php // Hero
  $opacity = get_sub_field('opacity_overlay');
  $bgImage = get_sub_field('background_image');
?>
<section class="home hero">
  <div class="background" style="background: linear-gradient(rgba(0, 0, 0, 0.<?php echo $opacity; ?>), rgba(0, 0, 0, 0.<?php echo $opacity; ?>)), url(' <?php echo $bgImage; ?> ') center center no-repeat; background-size: cover;"></div>
  <div class="float">
    <div class="container">
      <div class="content eight columns">
      <?php if( have_rows('content') ): // Content ?>
        <?php while( have_rows('content') ): the_row(); 
          $title  = get_sub_field('title');
          $content = get_sub_field('content');
          $button = get_sub_field('button');
        ?>
      <h1><?php echo $title; ?></h1>
      <?php echo $content; ?>
      <?php if( $button ): 
        $link_url = $button['url'];
        $link_title = $button['title'];
        $link_target = $button['target'] ? $button['target'] : '_self';
      ?>
      <p><a href="<?php echo esc_url( $link_url ); ?>" class="button secondary" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></p>
      <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; ?> 
      </div>
    </div>
  </div>
</section>