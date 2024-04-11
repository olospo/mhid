<?php /* 404 Page */
get_header(); ?>

<section class="hero single">
  <div class="container">
    <div class="content ten columns">
      <h1>Page Not Found</h1>
      <p>Unfortunately we can't find the page you are looking for.</p>
    </div>
  </div>  
</section>

<section class="post not_found">
  <div class="container flex">
    <div class="content twelve columns">
      
      <p>You could try:</p>
      <ul>
        <li>Returning to the previous page you were on</li>
        <li>Heading to our <a href="<?php echo get_site_url(); ?>">homepage</a></li>
        <li>Using the navigation menu or search bar at the top of this page.</li>
      </ul>
    </div>
  </div>
</section>

<?php get_footer(); ?>