<?php /* Resource Archive */
get_header(); ?>

<section class="hero single">
  <div class="container">
    <div class="content ten columns">
      <h1>Resources</h1>
    </div>
  </div>
</section>

<section class="breadcrumbs">
  <div class="container">
  <?php if (function_exists('breadcrumbs')) breadcrumbs(); ?>
  </div>
</section>

<section class="archive">
  <div class="container">
    <div class="twelve columns">
      <div class="news_listing">
        <?php 
          query_posts(array( 
            'post_type' => 'resource',
            'showposts' => 24,
          ));  
        ?>
        <div class="news_listing">
            <?php if ( have_posts() ) : while (have_posts()) : the_post();  ?>
              <?php get_template_part('inc/article-resource'); ?>
            <?php endwhile; ?>
          </div>
          <div class="twelve columns">
          <?php numeric_posts_nav(); ?>
          </div>
          <?php else : ?>
          <!-- No posts found -->
          <?php endif; wp_reset_query(); ?>
        </div>
        
        
    </div>
  </div>
</section>

<?php get_footer();  ?>