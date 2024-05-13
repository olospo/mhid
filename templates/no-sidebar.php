<?php /* Template Name: No Sidebar */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>

<section class="hero single">
  <div class="container">
    <div class="content ten columns">
      <h1><?php the_title(); ?></h1>
    </div>
  </div>  
</section>

<section class="breadcrumbs">
  <div class="container">
  <?php if (function_exists('breadcrumbs')) breadcrumbs(); ?>
  </div>
</section>

<section class="post">
  <div class="container flex">
    <div class="content twelve columns">
      <?php the_content(); ?>
    </div> 
  </div>
</section>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>