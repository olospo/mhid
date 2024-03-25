<?php 
$color = get_sub_field('colour_scheme');
$layout = get_sub_field('section_layout'); 

if( $layout == 'left' ) { ?>
<section class="square_section <?php echo $color; ?> <?php echo $layout; ?>">
  <div class="container">
    <?php if( have_rows('image') ): // Image ?>
      <?php while( have_rows('image') ): the_row(); ?>
      <div class="square_background" style="background: url('<?php echo get_sub_field('square_image'); ?>') center center no-repeat; background-size:cover;"></div>
      <?php endwhile; ?>
    <?php endif; ?>
    
    <?php if( have_rows('content') ): // Content ?>
      <?php while( have_rows('content') ): the_row(); 
      $title = get_sub_field('title');
      $content = get_sub_field('content');
      $button = get_sub_field('button');
      ?>
    <div class="square_content right">
      <div class="content">
        <?php if( $title ): ?>
        <div class="title">
          <h3><?php echo $title; ?></h3>
        </div>
        <?php endif; ?>
        <?php echo $content; ?>
        <?php if( $button ): 
          $link_url = $button['url'];
          $link_title = $button['title'];
          $link_target = $button['target'] ? $button['target'] : '_self';
        ?>
        <p><a href="<?php echo esc_url( $link_url ); ?>" class="button primary" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></p>
        <?php endif; ?>
      </div>
    </div>
      <?php endwhile; ?>
    <?php endif; ?> 
  </div>
</section>

<?php } if( $layout == 'right' ) { ?>
<section class="square_section <?php echo $color; ?> <?php echo $layout; ?>">
  <div class="container">
    <?php if( have_rows('content') ): // Content ?>
      <?php while( have_rows('content') ): the_row(); 
      $title = get_sub_field('title');
      $content = get_sub_field('content');
      $button = get_sub_field('button');
      $custom = get_sub_field('custom_title_split');
      $split = get_sub_field('split_title');
      ?>
    <div class="square_content">
      <div class="content">
        <?php if( $title ): ?>
        <div class="title">
          <h3><?php echo $title; ?></h3>
        </div>
        <?php endif; ?>
        <?php echo $content; ?>
        <?php if( $button ): 
          $link_url = $button['url'];
          $link_title = $button['title'];
          $link_target = $button['target'] ? $button['target'] : '_self';
        ?>
        <p><a href="<?php echo esc_url( $link_url ); ?>" class="button primary" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></p>
        <?php endif; ?>
      </div>
    </div>
      <?php endwhile; ?>
    <?php endif; ?>
    
    <?php if( have_rows('image') ): // Image ?>
      <?php while( have_rows('image') ): the_row(); ?>
      <div class="square_background" style="background: url('<?php echo get_sub_field('square_image'); ?>') center center no-repeat; background-size:cover;"></div>
      <?php endwhile; ?>
    <?php endif; ?>
    
  </div>
</section>
<?php } ?>