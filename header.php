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
      <?php wp_nav_menu( array( 'theme_location' => 'countries', 'container'=> false, 'menu_class'=> false ) ); ?>
    </div>
</header>
<header class="main">
  <div class="container">
    <div class="logo two columns">  
      <?php if ( is_front_page() ) { ?>
      <h1 class="site-title">
        <a href="<?php echo get_site_url(); ?>">
          <img src="<?php bloginfo('template_directory'); ?>/img/logo.svg" alt="Informed Health Choices">
        </a>
      </h1>
      <?php } else { ?>
      <p class="site-title">
        <a href="<?php echo get_site_url(); ?>">
          <img src="<?php bloginfo('template_directory'); ?>/img/logo.svg" alt="Informed Health Choices">
        </a>
      <p>
      <?php } ?>
    </div>
    <nav class="primary ten columns">
      <?php wp_nav_menu( array( 'theme_location' => 'main', 'container'=> false, 'menu_class'=> false ) ); ?>
      <!-- Search -->
      <div class="search">
        <label for="search"><div class="search_icon"></div></label>
        <div class="search_form"><?php get_search_form(); ?></div>
      </div>
    </nav>
    <a class="menu-toggle mobile_menu" aria-controls="primary-menu">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
    </a>
  </div>
</header>
<nav class="mobile">
  <?php wp_nav_menu( array( 'theme_location' => 'main', 'container'=> false, 'menu_class'=> false ) ); ?>
</nav>