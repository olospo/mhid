<article class="one-third column">
  <a href="<?php the_permalink(); ?>">
  <div class="image">
    <img src="<?php the_post_thumbnail_url( 'featured-img' ); ?>" />
  </div>
  </a>
  <div class="content">
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    
    <?php if ( get_field('event') ): 
      $event_date = get_field('event_date'); // format: Y-m-d
      $start_time = get_field('event_start_time'); // format: H:i
      $end_time = get_field('event_end_time'); // format: H:i
    ?>
      <span class="date"><?php echo $event_date . ' - ' . $start_time . ' to ' . $end_time; ?></span>
    <?php else: ?>
      <span class="date"><?php the_time("F j, Y"); ?></span>
    <?php endif; ?>
    
    <!-- Display categories -->
    <?php 
    $categories = get_the_category(); 
    if ( ! empty( $categories ) ) { ?>
      <div class="categories">
      <?php foreach ( $categories as $category ) {
        echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="category-link">' . esc_html( $category->name ) . '</a> ';
      } ?>
    </div>
    <?php } ?>
    
    <?php the_excerpt(); ?>
    <a href="<?php the_permalink(); ?>" class="button primary">Read more</a>
  </div>
</article>