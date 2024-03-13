<a href="<?php echo get_site_url(); ?>">
  <?php 
  $current_site_id = get_current_blog_id();
  $logo_path = '/img/mhid_logo.png'; // Default logo path

  switch ($current_site_id) {
    case 1: // Site 1 
      $logo_path = '/img/mhid_logo.png';
      break;
    case 2: // ANDY
      $logo_path = '/img/andy_logo.png';
      break;
    case 3: // Supporting Early Minds
      $logo_path = '/img/earlyminds_logo.png';
      break;
    case 4: // Wisdom
      $logo_path = '/img/wisdom_logo.png';
      break;
    case 5: // YAG
      $logo_path = '/img/mhid_logo.png';
      break;
    case 6: // YAG
      $logo_path = '/img/aim_logo.png';
      break;
  }
  ?>
  <img src="<?php bloginfo('template_directory'); ?><?php echo $logo_path; ?>" alt="<?php echo bloginfo( 'name' ); ?>">
</a>