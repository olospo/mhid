<?php /* Template Name: Flexible */
get_header();

while ( have_posts() ) : the_post(); 

$has_hero = false; // Flag to indicate the presence of a 'hero' layout
$breadcrumbs_displayed = false; // Flag to track breadcrumbs insertion
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

if (!$has_hero): ?>
<section class="hero single">
  <div class="container">
    <div class="content ten columns">
      <h1><?php the_title(); ?></h1>
    </div>
  </div>  
</section>
<?php endif; ?>

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
        endif;
    endwhile; 
    ?>
</div>
<?php endif; ?>

<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>