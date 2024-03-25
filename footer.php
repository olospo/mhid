<?php /* Footer */ ?>
<?php wp_footer(); ?>
<footer>
  <div class="container">
    <div class="logo four columns">
      <img src="<?php bloginfo('template_directory'); ?>/img/mhid_footer_logo.png" alt="<?php echo bloginfo( 'name' ); ?>">
    </div>
    <div class="links eight columns">
      <div class="one-third column">
        <h5>Get in touch</h5>
        <address>
          Address line one<br />
          Address line two<br />
          Address line three
        </address>
        <p>Email: <a href="mailto:email@mhid.org.uk">email@mhid.org.uk</a><br />
        Phone: <a href="tel:2342342342342">01865 112233</a></p>
      </div>
      <div class="one-third column">
        <h5>Research</h5>
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
          <li><a href="#">Terms & Conditions</a></li>
        </ul>
        <h5>Connect with us</h5>
        <ul>
          <li><a href="#">Facebook</a></li>
          <li><a href="#">LinkedIn</a></li>
        </ul>
      </div>
    </div>
    <div class="row">
      <div class="copyright twelve columns">
        <p>Copyright &copy; Mental Health in Development <?php echo date("Y"); ?></p>
      </div>
  </div>
</footer>
</body>
</html>
