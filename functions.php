<?php

function theme_setup() {
  // Menus
  register_nav_menu( 'main', 'Main Menu' );
  register_nav_menu( 'footer', 'Footer Menu' );
  register_nav_menu( 'network', 'Network Menu');
  
  // RSS Feed
  add_theme_support( 'automatic-feed-links' );
  // Thumbnails
  add_theme_support( 'post-thumbnails' );
  add_image_size( 'thumb', 150, 150, true ); // Normal thumbnail size
  add_image_size( 'large-thumb', 300, 300, true ); // Large thumbnail size 
  add_image_size( 'featured-img', 740, 420, true ); // Featured Image size 
  add_image_size( 'background-img', 1400, 700, true ); // Featured Image size 
}
add_action( 'after_setup_theme', 'theme_setup' );

// Enqueue styles
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
  wp_enqueue_style( 'main', get_stylesheet_directory_uri().'/css/main.css', false, filemtime( get_stylesheet_directory() . '/style.css' ) );
}

// Enqueue scripts
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );
function theme_enqueue_scripts() {

  wp_deregister_script( 'jquery' ); // Deregister to put jQuery into footer
  wp_register_script( 'jquery', get_stylesheet_directory_uri().'/js/jquery.min.js', false, NULL, true );
  
  wp_enqueue_script( 'jquery' ); // Re-register jQuery
  
  wp_enqueue_script( 'modernizr', get_stylesheet_directory_uri().'/js/application.min.js', 'jquery', NULL, true );
  wp_enqueue_script(
      'theme-functions',
      get_stylesheet_directory_uri() . '/js/functions.js',
      array('jquery'),  // Dependencies should be in an array
      filemtime( get_stylesheet_directory() . '/style.css' ), // Version number
      true  // Load in footer
  );

}

// Disable Emoji Loading
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Function to display global menu
function custom_global_menu() {
  // Specify the site ID of the site where the menu is created
  $menu_site_id = 1; // Change this to the ID of the site where your menu is created

  // Get the menu from the specified site
  switch_to_blog($menu_site_id);
  $menu = wp_nav_menu(array(
    'theme_location' => 'network', // Replace 'Global Menu' with the name of your menu
    'echo' => false,
    'menu_class' => 'sites', 
  ));
  restore_current_blog();

  // Display the menu
  echo $menu;
}



// Disable WP Embed
function my_deregister_scripts() {
 wp_dequeue_script( 'wp-embed' );
}
add_action( 'wp_footer', 'my_deregister_scripts' );

// Excerpt Length
function excerpt_length($length) {
  return 30;
}
add_filter('excerpt_length', 'excerpt_length');

// Read More after excerpt
function new_excerpt_more($more) {
  global $post;
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

// Get ID from Page Name
function ID_from_page_name($page_name)
{
	global $wpdb;
	$page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".$page_name."'");
	return $page_name_id;
}

// Pagination
function numeric_posts_nav() {
	if( is_singular() )
		return;
	global $wp_query;
	/** Stop execution if there's only 1 page */
	if( $wp_query->max_num_pages <= 1 )
		return;
	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );
	/**	Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;
	/**	Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}
	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}
	echo '<div class="pagination"><ul>' . "\n";
	/**	Previous Post Link */
	if ( get_previous_posts_link() )
		printf( '<li class="prev">%s</li>' . "\n", get_previous_posts_link('< Previous Page') );
	/**	Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
		if ( ! in_array( 2, $links ) )
			echo '<li>…</li>';
	}
	/**	Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}
	/**	Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) )
			echo '<li>…</li>' . "\n";
		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}
	/**	Next Post Link */
	if ( get_next_posts_link() )
		printf( '<li class="next">%s</li>' . "\n", get_next_posts_link('Next Page >') );
	echo '</ul></div>' . "\n";
}
// This stuff fixes the pagination issue with custom posts. 
function remove_page_from_query_string($query_string)
{ 
    if ($query_string['name'] == 'page' && isset($query_string['page'])) {
        unset($query_string['name']);
        // 'page' in the query_string looks like '/2', so i'm spliting it out
        list($delim, $page_index) = split('/', $query_string['page']);
        $query_string['paged'] = $page_index;
    }      
    return $query_string;
}

// Remove Menu Items 
function remove_menus(){
  // remove_menu_page( 'tools.php' );                  //Tools
}
add_action( 'admin_menu', 'remove_menus' );

function custom_post_type() {
  // Resources Post Type
  $labels = array(
    'name'                => _x( 'Resource', 'Post Type General Name', 'text_domain' ),
    'singular_name'       => _x( 'Resource', 'Post Type Singular Name', 'text_domain' ),
    'menu_name'           => __( 'Resources', 'text_domain' ),
    'all_items'           => __( 'All Resources', 'text_domain' ),
    'view_item'           => __( 'View Resource', 'text_domain' ),
    'add_new_item'        => __( 'Add New Resource', 'text_domain' ),
    'add_new'             => __( 'Add New', 'text_domain' ),
    'edit_item'           => __( 'Edit Resource', 'text_domain' ),
    'update_item'         => __( 'Update Resource', 'text_domain' ),
    'search_items'        => __( 'Search Resources', 'text_domain' ),
    'not_found'           => __( 'Not found', 'text_domain' ),
    'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
  );
  $args = array(
    'label'               => __( 'Resource', 'text_domain' ),
    'description'         => __( 'IHC Resources', 'text_domain' ),
    'labels'              => $labels,
    'supports'            => array( 'title', 'editor', 'thumbnail', 'revisions', 'custom fields', 'excerpt' ),
    'hierarchical'        => false,
    'public'              => true,
    'show_ui'             => true,
    'show_in_menu'        => true,
    'show_in_nav_menus'   => true,
    'show_in_admin_bar'   => true,
    'menu_position'       => 26,
    'menu_icon'           => 'dashicons-editor-alignleft',
    'can_export'          => true,
    'has_archive'         => true,
    'exclude_from_search' => false,
    'publicly_queryable'  => true,
    'capability_type'     => 'post',
    'show_in_rest'          => true,
  );
  register_post_type( 'resource', $args );
}
// Ensure the custom post type registration runs during the appropriate action
add_action( 'init', 'custom_post_type' );

function register_resource_taxonomies() {
  // Resource Categories (hierarchical, like normal categories)
  $cat_labels = array(
    'name'              => _x( 'Resource Categories', 'taxonomy general name', 'text_domain' ),
    'singular_name'     => _x( 'Resource Category', 'taxonomy singular name', 'text_domain' ),
    'search_items'      => __( 'Search Resource Categories', 'text_domain' ),
    'all_items'         => __( 'All Resource Categories', 'text_domain' ),
    'parent_item'       => __( 'Parent Resource Category', 'text_domain' ),
    'parent_item_colon' => __( 'Parent Resource Category:', 'text_domain' ),
    'edit_item'         => __( 'Edit Resource Category', 'text_domain' ),
    'update_item'       => __( 'Update Resource Category', 'text_domain' ),
    'add_new_item'      => __( 'Add New Resource Category', 'text_domain' ),
    'new_item_name'     => __( 'New Resource Category Name', 'text_domain' ),
    'menu_name'         => __( 'Categories', 'text_domain' ),
  );

  register_taxonomy(
    'resource-category',
    array( 'resource' ),
    array(
      'hierarchical'      => true,
      'labels'            => $cat_labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => 'resource-category', 'with_front' => false ),
      'show_in_rest'      => true, // ✅ shows in Gutenberg
    )
  );

  // Resource Tags (flat, like post tags)
  $tag_labels = array(
    'name'                       => _x( 'Resource Tags', 'taxonomy general name', 'text_domain' ),
    'singular_name'              => _x( 'Resource Tag', 'taxonomy singular name', 'text_domain' ),
    'search_items'               => __( 'Search Resource Tags', 'text_domain' ),
    'popular_items'              => __( 'Popular Resource Tags', 'text_domain' ),
    'all_items'                  => __( 'All Resource Tags', 'text_domain' ),
    'edit_item'                  => __( 'Edit Resource Tag', 'text_domain' ),
    'update_item'                => __( 'Update Resource Tag', 'text_domain' ),
    'add_new_item'               => __( 'Add New Resource Tag', 'text_domain' ),
    'new_item_name'              => __( 'New Resource Tag Name', 'text_domain' ),
    'separate_items_with_commas' => __( 'Separate tags with commas', 'text_domain' ),
    'add_or_remove_items'        => __( 'Add or remove tags', 'text_domain' ),
    'choose_from_most_used'      => __( 'Choose from the most used tags', 'text_domain' ),
    'menu_name'                  => __( 'Tags', 'text_domain' ),
  );

  register_taxonomy(
    'resource-tag',
    array( 'resource' ),
    array(
      'hierarchical'      => false,
      'labels'            => $tag_labels,
      'show_ui'           => true,
      'show_admin_column' => true,
      'query_var'         => true,
      'rewrite'           => array( 'slug' => 'resource-tag', 'with_front' => false ),
      'show_in_rest'      => true, // ✅ shows in Gutenberg
    )
  );
}
add_action( 'init', 'register_resource_taxonomies' );

// Add unique body class based on the current site ID
function add_site_specific_body_class($classes) {
  // Get the current site ID
  $current_site_id = get_current_blog_id();

  // Define custom body class based on site ID
  switch ($current_site_id) {
    case 1:
      // Body class for main site
      $classes[] = 'main-site';
      break;

    case 2:
      // Body class for subsite 1
      $classes[] = 'subsite-1';
      break;

    case 3:
      // Body class for subsite 2
      $classes[] = 'subsite-2';
      break;

    case 4:
      // Body class for subsite 3
      $classes[] = 'subsite-3';
      break;

    case 5:
      // Body class for subsite 4
      $classes[] = 'subsite-4';
      break;
      
    case 6:
      // Body class for subsite 5
      $classes[] = 'subsite-5';
      break;
      
    case 7:
      // Body class for subsite 5
      $classes[] = 'subsite-6';
      break;

    // Add more cases for additional subsites as needed

    default:
      // Default body class if no specific match is found
      $classes[] = 'default-site';
      break;
  }

  return $classes;
}

// Hook the function into the body_class filter
add_filter('body_class', 'add_site_specific_body_class');

// Custom login
function enqueue_custom_login_styles() {
    // Get the current site's URL
    $site_url = site_url();

    // Extract subdomain from the site's URL
    $subdomain = explode('.', parse_url($site_url, PHP_URL_HOST))[0];

    // Enqueue different stylesheets based on the subdomain
    switch ($subdomain) {
      case 'mhid':
        // CSS file for main site login
        wp_enqueue_style('mhid-login-styles', get_stylesheet_directory_uri() . '/login/mhid-login-style.css');
        break;

      case 'andyoxford':
        // CSS file for andyoxford site login
        wp_enqueue_style('andyoxford-login-styles', get_stylesheet_directory_uri() . '/login/andyoxford-login-style.css');
        break;

      case 'supportingearlyminds':
        // CSS file for supportingearlyminds site login
        wp_enqueue_style('gearlyminds-login-styles', get_stylesheet_directory_uri() . '/login/earlyminds-login-style.css');
        break;

      case 'wisdom':
        // CSS file for wisdom site login
        wp_enqueue_style('wisdom-login-styles', get_stylesheet_directory_uri() . '/login/wisdom-login-style.css');
        break;

      case 'insights':
        // CSS file for yag site login
        wp_enqueue_style('insights-login-styles', get_stylesheet_directory_uri() . '/login/insights-login-style.css');
        break;
        
      case 'aim':
        // CSS file for yag site login
        wp_enqueue_style('aim-login-styles', get_stylesheet_directory_uri() . '/login/aim-login-style.css');
        break;

      default:
        // Default CSS file if no specific match is found
        wp_enqueue_style('default-login-styles', get_stylesheet_directory_uri() . '/login/mhid-login-style.css');
        break;
    }
}
add_action('login_enqueue_scripts', 'enqueue_custom_login_styles');

// Change login logo URL
function custom_login_logo_url() {
return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'custom_login_logo_url' );

function custom_login_logo_url_title() {
return 'Default Site Title';
}
add_filter( 'login_headertitle', 'custom_login_logo_url_title' );

// Hook into the 'init' action
add_action( 'init', 'custom_post_type', 0 );

// Page Excerpt support
add_post_type_support( 'page', 'excerpt' );

// CPT Menu Item
add_filter('nav_menu_css_class', 'current_type_nav_class', 10, 2);
function current_type_nav_class($classes, $item) {
  // Get post_type for this post
  $post_type = get_query_var('post_type');

  // Go to Menus and add a menu class named: {custom-post-type}-menu-item
  // This adds a 'current_page_parent' class to the parent menu item
  if( in_array( $post_type.'-menu-item', $classes ) )
      array_push($classes, 'current_page_parent');

  return $classes;
}

class childNav extends Walker_page {
  public function start_el(&$output, $page, $depth = 0, $args = array(), $current_page = 0) {
    if($depth)
        $indent = str_repeat("\t", $depth);
    else
        $indent = '';
    extract($args, EXTR_SKIP);
    $css_class = array('page_item');
    if(!empty($current_page)) {
        $_current_page = get_page( $current_page );
        $children = get_children('post_parent='.$page->ID);
        if(count($children) != 0) {
            $css_class[] = 'hasChildren';
        }
        if(isset($_current_page->ancestors) && in_array($page->ID, (array) $_current_page->ancestors))
            $css_class[] = 'current_page_ancestor';
        if($page->ID == $current_page)
            $css_class[] = 'current_page_item';
        elseif($_current_page && $page->ID == $_current_page->post_parent)
            $css_class[] = 'current_page_parent';
    } elseif($page->ID == get_option('page_for_posts')) {
        $css_class[] = 'current_page_parent';
    }
    $css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );
    if($page->ID == $current_page) {
        $output .= $indent .'<li class="' . $css_class . '"><a href="' . get_permalink($page->ID) . '">' . $page->post_title .'</a>';
    } else {
        $output .= $indent .'<li class="' . $css_class . '"><a href="' . get_permalink($page->ID) . '">' . $page->post_title .'</a>';
    }
  }
}

// Breadcrumbs
function breadcrumbs() {
 
  /* === OPTIONS === */
  $text['home']     = 'Home'; // text for the 'Home' link
  $text['category'] = '%s'; // text for a category page
  $text['search']   = 'Search Results for "%s"'; // text for a search results page
  $text['tag']      = 'Posts Tagged "%s"'; // text for a tag page
  $text['author']   = 'Articles Posted by %s'; // text for an author page
  $text['404']      = 'Error 404'; // text for the 404 page
 
  $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $delimiter   = '<span class="delimiter">/</span>'; // delimiter between crumbs
  $before      = '<span class="current">'; // tag before the current crumb
  $after       = '</span>'; // tag after the current crumb
  /* === END OF OPTIONS === */
 
  global $post;
  $homeLink = get_bloginfo('url') . '/';
  $linkBefore = '<span typeof="v:Breadcrumb">';
  $linkAfter = '</span>';
  $linkAttr = ' rel="v:url" property="v:title"';
  $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;
  
  $blog_id = get_current_blog_id();
  switch ($blog_id) {
    case 5: // the site that wants /our-work/
      $posts_section = [
        'url'   => trailingslashit($homeLink . 'our-work'),
        'label' => 'Our Work'
      ];
      break;
    default:
      $posts_section = [
        'url'   => trailingslashit($homeLink . 'news'),
        'label' => 'News'
      ];
  }

 
  if (is_home() || is_front_page()) {
 
    if ($showOnHome == 1) echo '<a href="' . $homeLink . '">' . $text['home'] . '</a>';
 
  } else {
 
    echo '<div id="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf($link, $homeLink, $text['home']) . $delimiter;
 
    if ( is_category() ) {
      $thisCat = get_category(get_query_var('cat'), false);
    
      // Always start with a link to the News page
      echo sprintf($link, $homeLink . '/news', 'News') . $delimiter;
    
      // If this category has a parent, show the hierarchy
      if ( $thisCat->parent != 0 ) {
        $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);
        $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
        $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
        echo $cats;
      }
    
      // Finally, show the current category
      echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;
    
    } elseif ( is_search() ) {
      echo $before . sprintf($text['search'], get_search_query()) . $after;
 
    } elseif ( is_day() ) {
    //echo sprintf($link, '/category/news' , 'News') . $delimiter;	
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
      echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;
      echo $before . get_the_time('d') . $after;
 
    } elseif ( is_month() ) {
    //echo sprintf($link, '/category/news' , 'News') . $delimiter;	
      echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;
      echo $before . get_the_time('F') . $after;
 
    } elseif ( is_year() ) {
   // echo sprintf($link, '/category/news' , 'News') . $delimiter;	
      echo $before . get_the_time('Y') . $after;
 
    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $post_type = get_post_type_object(get_post_type());
    
        $slug = $post_type->rewrite;
        printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);
        if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
      } else {
        echo sprintf($link, $posts_section['url'], $posts_section['label']) . $delimiter;
        $cat = get_the_category(); $cat = $cat[0];
        $cats = get_category_parents($cat, TRUE, $delimiter);
        if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);
        $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
        $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
        // echo $cats;
        if ($showCurrent == 1) echo $before . get_the_title() . $after;
      }
 
    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      
     
    } elseif ( is_attachment() ) {
      $parent = get_post($post->post_parent);
      $cat = get_the_category($parent->ID); $cat = $cat[0];
      $cats = get_category_parents($cat, TRUE, $delimiter);
      $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);
      $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);
      echo $cats;
      printf($link, get_permalink($parent), $parent->post_title);
      if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
 
    } elseif ( is_page() && !$post->post_parent ) {
      if ($showCurrent == 1) echo $before . get_the_title() . $after;
 
    } elseif ( is_page() && $post->post_parent ) {
      $parent_id  = $post->post_parent;
      $breadcrumbs = array();
      while ($parent_id) {
        $page = get_page($parent_id);
        $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));
        $parent_id  = $page->post_parent;
      }
      $breadcrumbs = array_reverse($breadcrumbs);
      for ($i = 0; $i < count($breadcrumbs); $i++) {
        echo $breadcrumbs[$i];
        if ($i != count($breadcrumbs)-1) echo $delimiter;
      }
      if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;
 
    } elseif ( is_tag() ) {
      echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;
 
    } elseif ( is_author() ) {
       global $author;
      $userdata = get_userdata($author);
      echo $before . sprintf($text['author'], $userdata->display_name) . $after;
 
    } elseif ( is_404() ) {
      echo $before . $text['404'] . $after;
    }
 
    if ( get_query_var('paged') ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page') . ' ' . get_query_var('paged');
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
 
    echo '</div>';
 
  }
}


function tg_include_custom_post_types_in_search_results( $query ) {
  if ( $query->is_main_query() && $query->is_search() && ! is_admin() ) {
      $query->set( 'post_type', array( 'post', 'page' ) );
  }
}
add_action( 'pre_get_posts', 'tg_include_custom_post_types_in_search_results' );

// Convert number to their word equivalent 
function number_to_word($number) {
  $words = array(
    'zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten'
  );
    
  if ($number <= 10) {
    return $words[$number];
  }

  return $number;
}

function custom_menu_classes($classes, $item, $args) {
    // Check if it's the primary menu (adjust 'primary' to your actual menu location)
    if ($args->theme_location == 'main') {

        // Remove 'current_page_parent' from 'News' menu item on 'Resources' CPT archive or single CPT item
        if (is_post_type_archive('resource') || is_singular('resource')) {
            // Assuming 'News' is set as the blog page
            if ($item->object_id == get_option('page_for_posts')) {
                $classes = array_diff($classes, array('current_page_parent', 'current-menu-item', 'current_page_ancestor'));
            }
        }
        
        // Add 'current-menu-item' to 'Resources' menu item on 'Resources' CPT archive or single CPT item
        if (is_post_type_archive('resource') || is_singular('resource')) {
            if ($item->object == 'custom' && $item->url == get_post_type_archive_link('resources')) {
                $classes[] = 'current-menu-item';
            }
        }
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'custom_menu_classes', 10, 3);

// Private Content
function remove_protected_text($title) {
    return '%s';
}
add_filter('protected_title_format', 'remove_protected_text');

// Customise password-protected message
function custom_protected_text($content) {
    if (post_password_required()) {
        return custom_password_form();
    } else {
        return $content;
    }
}
add_filter('the_content', 'custom_protected_text');

// Override the default password form
function custom_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $output = '<form class="members" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <p>This section is for Network Members only.  Please enter the password below:</p>
    <input name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /><input type="submit" name="Submit" value="' . esc_attr__( 'Submit' ) . '" />
    </form><p>If you dont have a password, you can get in touch at <a href="mailto:wisdom.network@psy.ox.ac.uk">wisdom.network@psy.ox.ac.uk</a> to join the Network.</p>';
    return $output;
}
add_filter('the_password_form', 'custom_password_form');