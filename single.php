<?php /* Single Post */
get_header();

while ( have_posts() ) : the_post(); ?>

<section class="hero single">
  <div class="container">
    <div class="content ten columns">
      <h1><?php the_title(); ?></h1>
      <p><?php the_date(); ?></p>
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
    <div class="content twelve columns">
      <?php the_content(); ?>
      
      <!-- Display categories -->
      <?php $categories = get_the_category(); 
      if ( ! empty( $categories ) ) { ?>
      <div class="categories">
        <?php foreach ( $categories as $category ) {
          echo '<a href="' . esc_url( get_category_link( $category->term_id ) ) . '" class="category-link">' . esc_html( $category->name ) . '</a> ';
        } ?>
      </div>
      <?php } ?>
    </div>
  </div>
</section>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>