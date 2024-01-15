<?php /* Resource Archive */
get_header(); ?>

<?php if( have_rows('resources','option') ): ?>
<?php while( have_rows('resources','option') ): the_row(); 
  // Get sub field values.
  $title = get_sub_field('resources_title');
  $desc = get_sub_field('resources_description');
  $image = get_sub_field('resources_background_image');
  $opacity = get_sub_field('resources_overlay_opacity');
  ?>
  <section class="hero single">
    <div class="background" style="background: linear-gradient(rgba(0, 0, 0, <?php echo $opacity; ?>), rgba(0, 0, 0, <?php echo $opacity; ?>)), url('<?php echo $image; ?>') center center no-repeat; background-size: cover;">
    <div class="float">
      <div class="container">
        <div class="content eight columns">
          <h1><?php echo $title; ?></h1>
          <?php echo $desc; ?>
        </div>
      </div>
    </div>
  </section>
<?php endwhile; ?>
<?php endif; ?>

<section class="resources">
  <div class="container">
    <div class="twelve columns">
      <div class="news_listing">
        <?php 
          query_posts(array( 
            'post_type' => 'resource',
            'showposts' => 24,
          ));  
        ?>
          <?php if ( have_posts() ) : while (have_posts()) : the_post();  ?>
            
          <?php 
            $type = get_field('resource_type'); 
            $title = get_field('title');
            $description = get_field('link_description');
          ?>
          
          <?php if( $type == 'link' ): 
            $url = get_field( 'link_url');
          ?>
          <article class="three columns resource <?php echo $type; ?>">
            <?php echo $title; ?>
            <ul>
              <li><a href="<?php echo $url; ?>"><?php echo $description; ?></a></li>
            </ul>
          </article>
          <?php endif; ?>
          
          <?php if( $type == 'audio' ): 
            $url = get_field( 'audio_url', $resource->ID );
          ?>
          <article class="three columns resource <?php echo $type; ?>">
            <?php echo $title; ?>
            <ul>
              <li><a href="<?php echo $url; ?>"><?php echo $description; ?></a></li>
            </ul>
          </article>
          <?php endif; ?>
          
          <?php if( $type == 'video' ): 
            $url = get_field( 'video_url', $resource->ID );
          ?>
          <article class="three columns resource <?php echo $type; ?>">
            <?php echo $title; ?>
            <ul>
              <li><a href="<?php echo $url; ?>"><?php echo $description; ?></a></li>
            </ul>
          </article>
          <?php endif; ?>
            
          <?php if( $type == 'image' ): 
            $image = get_field( 'image_upload');
          ?>
          <article class="three columns resource <?php echo $type; ?>">
            <?php echo $title; ?>
            <ul>
              <li><a href="<?php echo $image; ?>"><?php echo $description; ?></a></li>
            </ul>
          </article>
          <?php endif; ?>
          
          <?php if( $type == 'document' ): 
            $document = get_field( 'document_upload');
            $extra = get_field( 'extra_document');
            $exUpload = get_field( 'extra_document_upload');
            $exDesc = get_field( 'extra_link_description');
          ?>
          <article class="three columns resource <?php echo $type; ?>">
            <?php echo $title; ?>
            <ul>
              <li><a href="<?php echo $document; ?>" download><?php echo $description; ?></a></li>
              <?php if ( $extra ): ?>
              <li><a href="<?php echo $exUpload; ?>" download><?php echo $exDesc; ?></a></li>
              <?php endif; ?>
            </ul>
          </article>
          <?php endif; ?>
 
          <?php endwhile; ?>
        </div>
        <div class="twelve columns">
        <?php numeric_posts_nav(); ?>
        </div>
        <?php else : ?>
        <!-- No posts found -->
        <?php endif; wp_reset_query(); ?>
    </div>
  </div>
</section>

<?php get_footer();  ?>