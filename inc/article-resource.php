<article class="one-third column">
  <a href="<?php the_permalink(); ?>">
    <div class="image">
      <img src="<?php the_post_thumbnail_url( 'featured-img' ); ?>" />
    </div>
  </a>
  <div class="content">
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

    <?php
    // Always show the Resource Category and Resource Type if this is a resource post type
    if ( get_post_type() === 'resource' ) :
    
      // Resource Category
      $categories = get_the_terms( get_the_ID(), 'resource-category' );
      if ( $categories && ! is_wp_error( $categories ) ) : ?>
        <div class="categories">
          <?php foreach ( $categories as $term ) :
            // Build a filter URL for this category
            $filter_url = add_query_arg(
              'resource-category',
              $term->slug,
              get_post_type_archive_link( 'resource' )
            );
          ?>
            <a href="<?php echo esc_url( $filter_url ); ?>" class="category-link">
              <?php echo esc_html( $term->name ); ?>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif;
    
      // Resource Type
      $types = get_the_terms( get_the_ID(), 'resource-type' );
      if ( $types && ! is_wp_error( $types ) ) : ?>
        <div class="resource-types">
          <?php foreach ( $types as $term ) :
            // Build a filter URL for this type
            $filter_url = add_query_arg(
              'resource-type',
              $term->slug,
              get_post_type_archive_link( 'resource' )
            );
          ?>
            <a href="<?php echo esc_url( $filter_url ); ?>" class="type-link">
              <?php echo esc_html( $term->name ); ?>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif;
    
    endif;
    ?>


    <?php the_excerpt(); ?>
    <a href="<?php the_permalink(); ?>" class="button primary">Read more</a>
  </div>
</article>
