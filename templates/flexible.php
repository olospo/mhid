<?php /* Template Name: Flexible */
get_header();

while ( have_posts() ) : the_post(); ?>

<?php if (have_rows('section_content')) { // Flexible Content ?>
<div class="flexible_content">        
  <?php while (have_rows('section_content')) { the_row(); ?>
    <?php if( get_row_layout() == 'hero' ): ?>
      <?php get_template_part( 'flex/hero'); // Hero ?>
    <?php elseif( get_row_layout() == 'stats' ): ?>
      <?php get_template_part( 'flex/stats'); // Stats ?>
    <?php elseif( get_row_layout() == 'square' ): ?>
      <?php get_template_part( 'flex/square'); // Square Section ?>
    <?php elseif( get_row_layout() == 'intro' ): ?>
      <?php get_template_part( 'flex/intro'); // Content Block ?>
    <?php endif; ?>
  <?php } ?>
</div>
<?php } ?>

<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
