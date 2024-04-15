<?php /* Header */  ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<title><?php wp_title( '|', true, 'left' ); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=3.0, minimal-ui" />
<?php wp_head(); ?>
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700;900&display=swap" rel="stylesheet"> 

<?php $current_site_id = get_current_blog_id(); switch ($current_site_id) { 
  case 2: // ANDY Typekit ?>
<link rel="stylesheet" href="https://use.typekit.net/mqg3rwg.css">
<?php break;
  case 4: // Wisdom Typekit ?>
<link rel="stylesheet" href="https://use.typekit.net/kwl7ryk.css">   
<?php break; } ?>

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
      <?php custom_global_menu(); ?>
    </div>
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
      <!-- <div class="search" role="search">
        <div class="search_form"><?php get_search_form(); ?></div>
      </div> -->
    </div>
    
  </div>
</nav>
<nav class="mobile">
  <?php wp_nav_menu( array( 'theme_location' => 'main', 'container'=> false, 'menu_class'=> false ) ); ?>
</nav>