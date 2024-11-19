<?php /* Archive */
get_header(); ?>

<div class="flexible_content">
    <?php 
    while (have_rows('section_content')): the_row(); 
        // Check if we're at the first 'content_section' and breadcrumbs haven't been shown
        if (get_row_layout() == 'content_section' && !$breadcrumbs_displayed):
          get_template_part('flex/breadcrumbs');
          $breadcrumbs_displayed = true; // Set the flag to true after displaying breadcrumbs
        endif;
        // Continue with your layout rendering
        if (get_row_layout() == 'hero'): 
          get_template_part('flex/hero'); // Hero section
        elseif (get_row_layout() == 'content_section'): 
          get_template_part('flex/content'); // Content section
        elseif (get_row_layout() == 'stats'): 
          get_template_part('flex/stats'); // Stats section
        elseif (get_row_layout() == 'square'): 
          get_template_part('flex/square'); // Square section
        elseif (get_row_layout() == 'intro'): 
          get_template_part('flex/intro'); // Intro section
        elseif (get_row_layout() == 'accordion'): 
          get_template_part('flex/accordion'); // Accordion section
        elseif (get_row_layout() == 'news_section'): 
          get_template_part('flex/news'); // Accordion section
        endif;
    endwhile; 
    ?>
</div>

<section class="archive">
  <div class="container">
    <div class="twelve columns">
      <div class="news_listing">
        <?php if ( have_posts() ) : while (have_posts()) : the_post();  ?>
          <?php get_template_part('inc/article'); ?>
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
</section>

<?php get_footer();  ?>