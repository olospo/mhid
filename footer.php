<?php /* Footer */ 
  // Contact Settings
  $email = get_field('email','options');
  // Social
  $facebook = get_field('facebook_link','options');
  $twitter = get_field('twitter_link','options');
  $linkedin = get_field('linkedin_link','options');
  $vimeo = get_field('vimeo_link','options');
  $instagram = get_field('instagram_link','options');
  $threads = get_field('threads_link','options');
?>

<footer class="footer">
  <div class="container">
    <div class="logo four columns">
      <img src="<?php bloginfo('template_directory'); ?>/img/mhid_footer_logo.png" alt="<?php echo bloginfo( 'name' ); ?>">
    </div>
    <div class="links eight columns">
      <div class="one-third column">
        <h5>Get in touch</h5>
        <p><a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></p>
        <?php
        // Check if at least one social icon is present
        if ($facebook || $twitter || $linkedin || $instagram || $threads):
        ?>
        <h5>Connect with us</h5>
        <ul class="social">
          <?php if($facebook): ?>
          <li><a href="<?php echo $facebook; ?>" aria-label="Facebook"><img src="<?php bloginfo('template_directory'); ?>/img/facebook.svg" alt="Facebook" loading="lazy"/></a></li>
          <?php endif; ?>
          <?php if($twitter): ?>
          <li><a href="<?php echo $twitter; ?>" aria-label="Twitter"><img src="<?php bloginfo('template_directory'); ?>/img/twitter.svg" alt="Twitter" loading="lazy"/></a></li>
          <?php endif; ?>
          <?php if($linkedin): ?>
          <li><a href="<?php echo $linkedin; ?>" aria-label="LinkedIn"><img src="<?php bloginfo('template_directory'); ?>/img/linkedin.svg" alt="LinkedIn" loading="lazy"/></a></li>
          <?php endif; ?>
          <?php if($instagram): ?>
          <li><a href="<?php echo $instagram; ?>" aria-label="Instagram"><img src="<?php bloginfo('template_directory'); ?>/img/instagram.svg" alt="Instagram" loading="lazy"/></a></li>
          <?php endif; ?>
          <?php if($threads): ?>
          <li><a href="<?php echo $threads; ?>" aria-label="Threads"><img src="<?php bloginfo('template_directory'); ?>/img/threads.svg" alt="Threads" loading="lazy"/></a></li>
          <?php endif; ?>
        </ul>
        <?php endif; ?>
      </div>
      <div class="one-third column">
        <h5>Our Work</h5>
        <?php 
        $current_site_id = is_main_site() ? 1 : get_current_blog_id(); // Get the ID of the current site
        $sites = get_sites();
        
        if ($sites) {
            echo '<ul class="footer-sites">';
            foreach ($sites as $site) {
                $site_id = $site->blog_id;
        
                // Check if the current site is the active one
                $is_current_site = ($current_site_id == $site_id) ? 'current-site' : '';
        
                // Add a unique class based on the site ID
                $site_details = get_blog_details($site_id);
                $site_class = 'site-' . $site_id;
        
                echo '<li class="' . esc_attr($site_class . ' ' . $is_current_site) . '"><a href="' . esc_url($site_details->siteurl) . '">' . esc_html($site_details->blogname) . '</a></li>';
            }
            echo '</ul>';
        } ?>
      </div>
      <div class="one-third column">
        <h5>Quick Links</h5>
        <ul>
          <li><a href="#">Privacy Policy</a></li>
          <li><a href="#">Cookies Policy</a></li>
        </ul>
        <h5>Search</h5>
        <!-- Search -->
        <div class="search" role="search">
          <div class="search_form"><?php get_search_form(); ?></div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="copyright twelve columns">
        <p>Copyright &copy; Mental Health in Development <?php echo date("Y"); ?></p>
      </div>
  </div>
</footer>
<?php wp_footer(); ?>
<a href="#" class="back_to_top">Back to Top</a>
</body>
</html>
