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
        if ( $post ) : 
            // Check if the current page has a parent.
            $parent_id = $post->post_parent;
            if ( $parent_id ) {
                // Fetch sibling pages including the current page.
                $args = array(
                    'post_type'     => 'page',
                    'post_parent'   => $parent_id, // Use post_parent to fetch siblings.
                    'post_status'   => 'publish', // Ensure only published pages are retrieved.
                    'nopaging'      => true, // Get all sibling pages without paging.
                    'post__not_in'  => array($post->ID) // Exclude the current post to not duplicate it in the list.
                );
            } else {
                // If no parent, this is a top-level page, fetch other top-level pages.
                $args = array(
                    'post_type'     => 'page',
                    'post_parent'   => 0, // Fetch only top-level pages.
                    'post_status'   => 'publish',
                    'nopaging'      => true,
                    'post__not_in'  => array($post->ID) // Exclude the current post to not duplicate it in the list.
                );
            }
        
            $siblings = new WP_Query($args);
            if ( $siblings->have_posts() ) :
        ?>
        <ul>
            <!-- Always include the current page -->
            <li class="current"><a href="<?php echo get_permalink($post->ID); ?>"><?php echo get_the_title($post->ID); ?></a></li>
            <?php while ( $siblings->have_posts() ) : $siblings->the_post(); // Loop through sibling pages. ?>
            <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
            <?php endwhile; wp_reset_postdata(); // Reset post data to the original global post. ?>
        </ul>
        <?php endif; endif; ?>
      </div>
      <?php } ?>
      <div>
      <h3>Sidebar</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
      </div>
    </div>
    <?php endwhile; endif; ?>
  </div>
</section>
<?php } ?>