<?php /* Single Post */
get_header();

while ( have_posts() ) : the_post(); ?>

<section class="hero single">
  <div class="container">
    <div class="content ten columns">
      <h1><?php the_title(); ?></h1>
      <?php if ( get_field('event') ): 
        $event_date = get_field('event_date'); // format: Y-m-d
        $start_time = get_field('event_start_time'); // format: H:i
        $end_time = get_field('event_end_time'); // format: H:i
      ?>
        <p><?php echo $event_date . ' - ' . $start_time . ' to ' . $end_time; ?></p>
      <?php else: ?>
        <p><?php the_date(); ?></p>
      <?php endif; ?>
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