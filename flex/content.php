<?php 
$layout = get_sub_field('columns'); 

if( $layout == 'one' ) { ?>
<section class="content_section one_column">
  <div class="container">
    <?php if( have_rows('column_one') ): while( have_rows('column_one') ): the_row(); // Content One
    $contentOne = get_sub_field('content_one');
    ?>
    <div class="twelve columns">
      <?php echo $contentOne; ?>
    </div>
    <?php endwhile; endif; ?>
  </div>
</section>

<?php } if( $layout == 'two' ) { ?>
<section class="content_section two_columns">
  <div class="container">
    <?php if( have_rows('column_one') ): while( have_rows('column_one') ): the_row(); // Content One
    $contentOne = get_sub_field('content_one');
    ?>
    <div class="six columns">
      <?php echo $contentOne; ?>
    </div>
    <?php endwhile; endif; ?>
    <?php if( have_rows('column_two') ): while( have_rows('column_two') ): the_row(); // Content Two
    $contentTwo = get_sub_field('content_two');
    ?>
    <div class="six columns">
      <?php echo $contentTwo; ?>
    </div>
    <?php endwhile; endif; ?>
  </div>
</section>
<?php } if( $layout == 'sidebar' ) { ?>
<section class="content_section two_columns">
  <div class="container">
    <?php if( have_rows('column_one') ): while( have_rows('column_one') ): the_row(); // Content One
    $contentOne = get_sub_field('content_one');
    ?>
    <div class="eight columns">
      <?php echo $contentOne; ?>
    </div>
    <?php endwhile; endif; ?>
    <?php if( have_rows('sidebar') ): while( have_rows('sidebar') ): the_row(); // Sidebar
    $nav = get_sub_field('page_navigation');
    ?>
    <aside class="four columns">
      <?php if( $layout ) { ?>
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
      <?php } ?>
      <div class="page_extra">
      <h3>Sidebar</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
    </div>
    <?php endwhile; endif; ?>
  </div>
</section>
<?php } ?>