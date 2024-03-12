<?php /* Header */  ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<title><?php wp_title( '|', true, 'left' ); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, minimal-ui" />
<?php wp_head(); ?>
<link rel="apple-touch-icon" sizes="180x180" href="<?php bloginfo('template_directory'); ?>/img/apple-touch-icon.png"/>
<link rel="icon" type="image/png" sizes="32x32" href="<?php bloginfo('template_directory'); ?>/img/favicon-32x32.png"/>
<link rel="icon" type="image/png" sizes="16x16" href="<?php bloginfo('template_directory'); ?>/img/favicon-16x16.png"/>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet"> 
<?php if( get_field('social_metadata', 'options') ): the_field('social_metadata', 'options'); endif; // Social Metadata ?>
<?php if( get_field('google_analytics', 'options') ): the_field('google_analytics', 'options'); endif; // Google Analytics Code ?>
<meta name="google-site-verification" content="add-content-here" />
</head>
<body <?php body_class(); ?>>

<header class="menu">
  <div class="container">
    <div class="twelve columns">
      <?php 
      $current_site_id = is_main_site() ? 1 : get_current_blog_id(); // Get the ID of the current site
      $sites = get_sites();
      
      if ($sites) {
          echo '<ul>';
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
</header>
<header class="main">
  <div class="container">
    <div class="logo three columns">  
      <?php if ( is_front_page() ) { ?>
      <h1 class="site-title">
        <a href="<?php echo get_site_url(); ?>">
          <img src="<?php bloginfo('template_directory'); ?>/img/mhid_logo.png" alt="<?php echo bloginfo( 'name' ); ?>">
        </a>
      </h1>
      <?php } else { ?>
      <p class="site-title">
        <a href="<?php echo get_site_url(); ?>">
          <img src="<?php bloginfo('template_directory'); ?>/img/mhid_logo.png" alt="<?php echo bloginfo( 'name' ); ?>">
        </a>
      <p>
      <?php } ?>
    </div>
    <div class="extra nine columns">
      <div class="nihr">
        <img src="<?php bloginfo('template_directory'); ?>/img/nihr_logo.png" alt="National Institute for Health and Care Research" />
      </div>
      <div class="searchbox" role="search">
        <div class="search_form"><?php get_search_form(); ?></div>
      </div>
    </div>
    
    <a class="menu-toggle mobile_menu" aria-controls="primary-menu">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </a>
  </div>
</header>
<div class="menu">
  <div class="container">
    <nav class="primary twelve columns">
<?php wp_nav_menu( array( 'theme_location' => 'main', 'container'=> false, 'menu_class'=> false ) ); ?>
    </nav>
    <nav class="mobile">
      <?php wp_nav_menu( array( 'theme_location' => 'main', 'container'=> false, 'menu_class'=> false ) ); ?>
    </nav>
  </div>
</div>
