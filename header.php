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

<?php $current_site_id = get_current_blog_id(); switch ($current_site_id) { case 4: // Wisdom Typekit ?>
<link rel="stylesheet" href="https://use.typekit.net/kwl7ryk.css">   
<?php break; } ?>

<?php if( get_field('social_metadata', 'options') ): echo get_field('social_metadata', 'options'); endif; // Social Metadata ?>
<?php if( get_field('google_analytics', 'options') ): echo get_field('google_analytics', 'options'); endif; // Google Analytics Code ?>
</head>
<body <?php body_class(); ?>>

<nav class="sites">
  <div class="container">
    <div class="twelve columns">
      <a aria-label="Toggle Menu" class="site-menu">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </a>
      <?php 
      $current_site_id = is_main_site() ? 1 : get_current_blog_id(); // Get the ID of the current site
      $sites = get_sites();
      
      if ($sites) {
        echo '<ul class="sites">';
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
</nav>
<header class="main">
  <div class="container">
    <div class="logo six columns">  
      <h1 class="site-title">
        <?php get_template_part( 'inc/logo' ); ?>
      </h1>
    </div>
    <div class="extra six columns">
      <div class="nihr">
        <img src="<?php bloginfo('template_directory'); ?>/img/nihr_logo.png" alt="National Institute for Health and Care Research" />
      </div>
    </div>
  </div>
</header>

<nav class="menu">
  <div class="container">
    <div class="primary twelve columns">
      <a class="menu-toggle mobile_menu" aria-controls="primary-menu">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
      </a>
      <?php wp_nav_menu( array( 'theme_location' => 'main', 'container'=> false, 'menu_class'=> false ) ); ?>
      <!-- Search -->
      <div class="search" role="search">
        <div class="search_form"><?php get_search_form(); ?></div>
      </div>
    </div>
    
  </div>
</nav>
<nav class="mobile">
  <?php wp_nav_menu( array( 'theme_location' => 'main', 'container'=> false, 'menu_class'=> false ) ); ?>
</nav>