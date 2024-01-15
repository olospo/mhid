<?php /* Page */

$sub = get_field('sub_title');

global $wp_query;
$current_page_obj = $wp_query->get_queried_object();
$current_page_hierarchy = get_post_ancestors($current_page_obj->ID);
$current_page_level = count($current_page_hierarchy);


get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>

<section class="hero single <?php if ($current_page_level == "2") { echo "level-three"; } ?>">
  <div class="container">
    <div class="content ten columns">
      <h1><?php the_title(); ?></h1>
     <?php if ($sub): ?><p><?php echo $sub; ?></p><?php endif; ?>
    </div>
  </div>  
</section>

<section class="post">
  <div class="container flex">
    <div class="content <?php if( have_rows('add_resource')) { ?>nine columns<?php } else { ?>twelve columns<?php } ?>">
      <div class="breadcrumbs">
        <?php if (function_exists('breadcrumbs')) breadcrumbs(); ?>
      </div>
      <?php the_content(); ?>
    <?php if (have_rows('section_content')) { // Flexible Content ?>
    <div class="flexible_content">
      <?php while (have_rows('section_content')) { the_row(); ?>
        <?php if( get_row_layout() == 'columns' ): ?>
          <?php get_template_part( 'flexible/columns'); // Column ?>
        <?php elseif( get_row_layout() == 'content_block' ): ?>
          <?php get_template_part( 'flexible/content_block'); // Content Block ?>
        <?php elseif( get_row_layout() == 'two_columns' ): ?>
          <?php get_template_part( 'flexible/two_columns'); // Content Block ?>
        <?php elseif( get_row_layout() == 'columns' ): ?>
          <?php get_template_part( 'flexible/columns'); // Content Block ?>
        <?php elseif( get_row_layout() == 'accordion' ): ?>
          <?php get_template_part( 'flexible/accordion'); // Accordion Block ?>
        <?php endif; ?>
      <?php } ?>
    </div>
    <?php } // End Flexible Content?>  
    </div> 
    
    <?php if( have_rows('add_resource')) { ?>
    <aside class="three columns">
      <div class="resources">
        <?php get_template_part( 'inc/resources' ); ?>
      </div>
    </aside>
    <?php }  wp_reset_postdata(); ?>
  </div>
</section>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>