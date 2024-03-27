<?php /* Template Name: Flexible */
get_header();

while ( have_posts() ) : the_post(); ?>

<?php
$has_hero = false; // Flag to indicate the presence of a 'hero' layout

// Preliminary scan to check for 'hero' layout
if (have_rows('section_content')) {
    while (have_rows('section_content')) {
        the_row();
        if (get_row_layout() == 'hero') {
            $has_hero = true;
            break; // Found a 'hero', no need to continue checking
        }
    }
}

// Reset the flexible content field so it can be looped through again
if (have_rows('section_content')): 
    // Manually rewind rows if necessary
    reset_rows(); // Use this if the above doesn't reset the loop
?>

<?php if (!$has_hero): ?>
  <section class="hero single">
    <div class="container">
      <div class="content ten columns">
        <h1><?php the_title(); ?></h1>
      </div>
    </div>  
  </section>
<?php endif; ?>

<div class="flexible_content">
    <?php while (have_rows('section_content')): the_row(); ?>
        <?php if (get_row_layout() == 'hero'): ?>
            <?php get_template_part('flex/hero'); // Hero section ?>
        <?php elseif (get_row_layout() == 'content_section'): ?>
            <?php get_template_part('flex/content'); // Content section ?>
        <?php elseif (get_row_layout() == 'stats'): ?>
            <?php get_template_part('flex/stats'); // Stats section ?>
        <?php elseif (get_row_layout() == 'square'): ?>
            <?php get_template_part('flex/square'); // Square section ?>
        <?php elseif (get_row_layout() == 'intro'): ?>
            <?php get_template_part('flex/intro'); // Intro section ?>
        <?php endif; ?>
    <?php endwhile; ?>
</div>

<?php endif; ?>


<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
