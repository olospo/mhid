<?php /* Single Post */
get_header();

while ( have_posts() ) : the_post(); ?>

<section class="hero single">
  <div class="container">
    <div class="content ten columns">
      <h1><?php the_title(); ?></h1>
      <p><?php the_excerpt(); ?></p>
    </div>
  </div>
</section>

<section class="breadcrumbs">
  <div class="container">
  <?php if (function_exists('breadcrumbs')) breadcrumbs(); ?>
  </div>
</section>

<section class="post news">
  <div class="container flex">
    <div class="content eight columns">
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
      <?php the_content(); ?>
    </div>
    <aside class="four columns">
      <div class="page_nav">
      <?php if ( class_exists( 'getit_widget' ) ) : // GET-IT Widget ?>
        <h3>Glossary</h3>
        <?php the_widget( 'getit_widget' );  ?>
      <?php endif; ?>
      </div>
    </aside>
  </div>
</section>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>