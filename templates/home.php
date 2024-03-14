<?php /* Template Name: Home */
get_header();

while ( have_posts() ) : the_post(); ?>

<section class="home hero">
  <div class="background" style="background: linear-gradient(rgba(0, 0, 0, 0.40), rgba(0, 0, 0, 0.40)), url(' <?php bloginfo('template_directory'); ?>/img/placeholder.jpg') center center no-repeat; background-size: cover;"></div>
  <div class="float">
    <div class="container">
      <div class="content eight columns">
      <h1>Creating effective mental health interventions for people</h1>
      <a href="#" class="button secondary">More Info</a> 
      </div>
    </div>
  </div>
</section>

<section class="home_about">
  <div class="container">
    <div class="twelve columns">
      <h2>About</h2>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
  </div>
</section>

<section class="home_resources">
  <div class="resources_bg" style="background: url('<?php bloginfo('template_directory'); ?>/img/placeholder.jpg') center center no-repeat; background-size: cover;"></div>
  <div class="resources_content">
    <div class="content">
      <h3>Resources</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      <a href="#" class="button primary">View all resources</a>
    </div>
  </div>
 
</section>
<?php endwhile; // end of the loop. ?>
<?php get_footer(); ?>
