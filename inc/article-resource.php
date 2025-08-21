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
    // Figure out which taxonomy to show on this card.
    $taxonomy = ( get_post_type() === 'resource' ) ? 'resource-category' : 'category';
    
    // Fetch terms for that taxonomy.
    $terms = get_the_terms( get_the_ID(), $taxonomy );
    
    if ( $terms && ! is_wp_error( $terms ) ) : ?>
      <div class="categories">
        <?php foreach ( $terms as $term ) : ?>
          <a href="<?php echo esc_url( get_term_link( $term ) ); ?>" class="category-link">
            <?php echo esc_html( $term->name ); ?>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
    
    <?php the_excerpt(); ?>
    <a href="<?php the_permalink(); ?>" class="button primary">Read more</a>
  </div>
</article>