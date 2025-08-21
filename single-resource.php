<?php /* Single Post */
get_header();

while ( have_posts() ) : the_post(); ?>

<section class="hero single">
  <div class="container">
    <div class="content ten columns">
      <h1><?php the_title(); ?></h1>
      <p><?php the_excerpt(); ?></p>
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
    <div class="content eight columns">
      <?php the_content(); ?>
    </div>
    <aside class="four columns">
      <div class="page_nav">
      <?php if ( class_exists( 'getit_widget' ) ) : // GET-IT Widget ?>
        <h3>Glossary</h3>
        <?php the_widget( 'getit_widget' );  ?>
      <?php endif; ?>
      </div>
    </aside>
  </div>
</section>
<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>