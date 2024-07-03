<?php /* Page */

get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>

<section class="hero single">
  <div class="container">
    <div class="content ten columns">
      <h1><?php the_title(); ?></h1>
    </div>
  </div>  
</section>

<section class="breadcrumbs">
  <div class="container">
  <?php if (function_exists('breadcrumbs')) breadcrumbs(); ?>
  </div>
</section>

<section class="post">
  <div class="container flex">
    <div class="content eight columns">
      <?php the_content(); ?>
    </div> 
    
    <aside class="four columns">
      <div class="page_nav">
        <h3>In this section</h3>
        <?php global $post;
        $current_page_id = $post->ID; // Save the current page ID for later comparison.
        
        if ( $post ) : 
          // Determine if the current page has a parent to fetch siblings accordingly.
          $parent_id = ($post->post_parent) ? $post->post_parent : $post->ID;
          // Setup the query arguments.
          $args = array(
            'post_type'     => 'page',
            'post_parent'   => $parent_id, // Fetch pages with the same parent.
            'post_status'   => 'publish', // Only published pages.
            'nopaging'      => true, // Get all pages without pagination.
            'orderby'       => 'menu_order', // Order by menu order.
            'order'         => 'ASC', // Ascending order.
          );
      
          $siblings = new WP_Query($args);
          if ( $siblings->have_posts() ) :
        ?>
        <ul>
          <?php while ( $siblings->have_posts() ) : $siblings->the_post(); ?>
          <li <?php if($current_page_id == get_the_ID()) echo 'class="current"'; ?>><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
          <?php endwhile; wp_reset_postdata(); // Reset post data to the original global post. ?>
        </ul>
        <?php endif; endif; ?>
      </div>
    </aside>
    <?php wp_reset_postdata(); ?>
  </div>
</section>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>