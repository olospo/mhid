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

<section class="archive">
  <div class="container">
    <div class="twelve columns">
      <div class="news_listing">
        <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <?php
            // If your inc/article partial is post-specific, consider a resource-specific partial:
            // get_template_part( 'inc/article', 'resource' );
            get_template_part( 'inc/article' );
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
