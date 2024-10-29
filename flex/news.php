<?php 
$items = get_sub_field('news_items');
$title = get_sub_field('news_title'); 
$terms = get_sub_field('news_category');
?>
<section class="news_items">
  <div class="container">
    <div class="twelve columns">
      <h2><?php echo $title; ?></h2>
      <div class="listing">

      <?php 
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      
        $args = array(
          'post_type' => 'post',
          'posts_per_page' => is_numeric($items) ? intval($items) : 3,
          'order' => 'DESC',
        ); 
        
        // If $terms is not empty and is an array, add tax_query to filter by category
        if (!empty($terms)) {
          // If terms are returned as an array of WP_Term objects
          if (is_array($terms)) {
            $terms_slugs = array_map(function($term) {
              return $term->slug; // Get the slug from the WP_Term object
            }, $terms);
          } else {
            $terms_slugs = array($terms->slug); // Handle a single WP_Term object
          }
        
          $args['tax_query'] = array(
            array(
              'taxonomy' => 'category', // Assuming you're using the default category taxonomy
              'field'    => 'slug', // You can also use 'term_id' or 'name'
              'terms'    => $terms_slugs, // Pass the array of slugs here
            ),
          );
        }
        
        $myposts = new WP_Query($args); ?>
        
        <?php if ( $myposts->have_posts() ) : while ($myposts->have_posts()) : $myposts->the_post(); ?>
        <?php get_template_part('inc/article'); ?>
      <?php endwhile; ?>
      <?php endif; wp_reset_postdata(); ?>  
      </div>
    </div>
  </div>
</section>