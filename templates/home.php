<?php /* Template Name: Home */
get_header();

$title = get_field('section_one_title');
$content = get_field('section_one_content');
$buttonText = get_field('section_one_button_text');
$buttonLink = get_field('section_one_button_link');
$video = get_field('section_one_video');

while ( have_posts() ) : the_post(); ?>

<?php get_template_part( 'inc/hero' ); ?>

<section class="post">
  <div class="container flex">
    <div class="content twelve columns">
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
        <?php elseif( get_row_layout() == 'glossary' ): ?>
          <?php get_template_part( 'flexible/glossary'); // Glossary ?>
        <?php endif; ?>
      <?php } ?>
    </div>
    <?php } // End Flexible Content?>  
    </div>
  </div>
</section>

<section class="home_carousel">
  <div class="container">
    <div class="heading twelve columns">
      <h3><?php the_field('section_heading'); ?></h3>
      <?php the_field('section_sub-heading'); ?>
    </div>
      
      <?php if( have_rows('resource__post') ): ?>
      <div class="slider twelve columns">
      <?php while ( have_rows('resource__post')) : the_row(); // loop through the repeater fields ?>
        <?php // set up post object
          $post_object = get_sub_field('resource');
          if( $post_object ) :
          $post = $post_object;
          setup_postdata($post);
        ?>
      
        <article class="slide"> 
          <a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url( 'background-img' ); ?>" /></a>
          <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
          <?php the_excerpt(); ?>
          
        </article>
      
          <?php wp_reset_postdata(); // IMPORTANT - reset the $post object so the rest of the page works correctly ?>
      
          <?php endif; ?> 
      
          <?php endwhile; ?>
      </div>
      <?php endif; ?>
      
    </div>
  </div>
</section>

<?php // get_template_part( 'inc/home_latest' ); ?>

<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
