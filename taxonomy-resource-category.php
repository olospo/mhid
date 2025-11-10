<?php /* Resource Category Archive */
get_header();

$term = get_queried_object();
?>

<section class="hero single">
  <div class="container">
    <div class="content ten columns">
      <h1><?php echo single_term_title('', false); ?></h1>
      <?php if ( is_tax( 'resource-category' ) && term_description() ) : ?>
        <p><?php echo term_description(); ?></p>
      <?php endif; ?>
    </div>
  </div>
</section>

<section class="filters">
  <div class="container">
    <?php get_template_part( 'inc/resource', 'filter' ); ?>
  </div>
</section>

<section class="archive">
  <div class="container">
    <div class="twelve columns">
      <div class="news_listing">
        <?php 
        $tax_query = array( 'relation' => 'AND' );
        
        // Current term (always included)
        $tax_query[] = array(
          'taxonomy' => 'resource-category',
          'field'    => 'slug',
          'terms'    => $term->slug,
        );
        
        // Optional extra filters
        if ( ! empty( $_GET['resource-type'] ) ) {
          $tax_query[] = array(
            'taxonomy' => 'resource-type',
            'field'    => 'slug',
            'terms'    => sanitize_text_field( $_GET['resource-type'] ),
          );
        }
        
        $args = array(
          'post_type'      => 'resource',
          'posts_per_page' => 24,
          'tax_query'      => $tax_query,
        );
        
        $query = new WP_Query( $args );
        ?>
        
        <?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>

          <?php
            get_template_part( 'inc/article-resource');
          ?>
        <?php endwhile; ?>
      </div>
      <div class="twelve columns">
        <?php if ( function_exists( 'numeric_posts_nav' ) ) numeric_posts_nav(); ?>
      </div>
      <?php else : ?>
        <!-- No resources found -->
      <?php endif; wp_reset_postdata(); ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>
