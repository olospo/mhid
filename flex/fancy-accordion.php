<?php if( have_rows('accordion') ): ?>
<section class="flexible fancy-accordion">
  <div class="container">
    <?php while( have_rows('accordion') ): the_row(); 
      $title   = get_sub_field('title');
      $content = get_sub_field('content');
      $button = get_sub_field('button');
    ?>
      <article class="accordionItem close">
        <div class="title accordionItemHeading">
          <div class="hexagon">
            <span class="hexagon__inner"></span>
          </div>
          <?php echo esc_html($title); ?>
          <span></span>
          <span></span>
        </div>
        <div class="accordionItemContent">
          <?php echo $content; ?>
          <?php if ( $button && ! empty( $button['url'] ) ): ?>
            <a href="<?php echo esc_url( $button['url'] ); ?>" target="<?php echo esc_attr( $button['target'] ?: '_self' ); ?>" class="button primary"><?php echo esc_html( $button['title'] ); ?></a>
          <?php endif; ?>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
</section>
<?php endif; ?>
