<?php if( have_rows('add_resource')): // check for repeater fields ?>
  <?php while ( have_rows('add_resource')) : the_row(); // loop through the repeater fields ?>

  <?php if( get_sub_field('resource_or_link') == 'resource' ) {
  $resource = get_sub_field('resource'); 
  if( $resource ): ?>
    <?php 
      $title = get_field( 'title', $resource->ID );
      $description = get_field( 'link_description', $resource->ID );

      $altTitle = get_sub_field( 'title' );
      $altDescription = get_sub_field( 'description');
      $linkText = get_sub_field('link_text');
    ?>
    <article class="resource">
      <h4><?php if( $altTitle ) { echo $altTitle; } else { echo $title; } ?></h4>
      <?php if( $altDescription ) { echo $altDescription; } else { ?><p><?php echo $description; ?></p><?php } ?>
      <p><a href="<?php the_permalink($resource->ID); ?>"><?php if( $linkText ) { echo $linkText; } else { ?>Read more<?php } ?></a></p>
    </article>
  <?php endif; } ?>
  
  <?php if( get_sub_field('resource_or_link') == 'link' ) {
  $link = get_sub_field('link'); 
  if( $link ): ?>
    <?php 
      $title = get_sub_field( 'title' );
      $description = get_sub_field( 'description');
      $linkText = get_sub_field('link_text');
      $link_target = $link['target'] ? $link['target'] : '_self';
    ?>
  
    <article class="resource link">
      <h4><?php echo $title; ?></h4>
      <?php echo $description; ?>
      <p><a href="<?php echo $link; ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php if( $linkText ) { echo $linkText; } else { ?>Read more<?php } ?></a></p>
    </article>
    
    
  <?php endif; } ?>
  
<?php endwhile; ?>
<?php endif; wp_reset_postdata(); ?>