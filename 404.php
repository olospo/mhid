<?php /* 404 Page */
get_header(); ?>

<section class="hero single">
  <div class="container">
    <div class="content ten columns">
      <h1>Page Not Found</h1>
    </div>
  </div>  
</section>

<section class="post not_found">
  <div class="container flex">
    <div class="content twelve columns">
      <p>It seems we can't find what you're looking for.</p>
      <p>Please try the navigation menu above or go to the <a href="<?php echo get_site_url(); ?>">homepage</a>.</p>
    </div>
  </div>
</section>

<?php get_footer(); ?>