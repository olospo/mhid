<?php if( have_rows('accordion') ): ?>
<section class="flexible fancy-accordion">
  <div class="container">
    <?php while( have_rows('accordion') ): the_row(); 
      $title   = get_sub_field('title');
      $content = get_sub_field('content');
    ?>
      <article class="accordionItem close">
        <div class="title accordionItemHeading">
          <!-- our hexagon indicator -->
          <div class="hexagon">
            <span class="hexagon__inner"></span>
          </div>
          <?php echo esc_html($title); ?>
          <span></span>
          <span></span>
        </div>
        <div class="accordionItemContent">
          <?php echo wp_kses_post($content); ?>
        </div>
      </article>
    <?php endwhile; ?>
  </div>
</section>
<?php endif; ?>
