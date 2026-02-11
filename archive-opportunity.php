<?php /* Resource Archive */
get_header(); ?>

<?php // Hero
  $opacity = get_field('opacity_overlay','option');
  $bgImage = get_field('background_image','option');
?>
<section class="home hero">
  <div class="background" style="background: linear-gradient(rgba(0, 0, 0, 0.<?php echo $opacity; ?>), rgba(0, 0, 0, 0.<?php echo $opacity; ?>)), url(' <?php echo $bgImage; ?> ') center center no-repeat; background-size: cover;"></div>
  <div class="float">
    <div class="container">
      <div class="content eight columns">
      <?php if( have_rows('content','option') ): // Content ?>
        <?php while( have_rows('content','option') ): the_row(); 
          $title  = get_sub_field('title','option');
          
          // Override title if on Past Opportunities archive
          if ( get_post_type() === 'opportunity' && get_query_var('opportunity_past') ) {
            $title = 'Past Opportunities';
          }
          $content = get_sub_field('content','option');
          $button = get_sub_field('button','option');
        ?>
      <h1><?php echo $title; ?></h1>
      <?php echo $content ?>
      <?php if( $button ): 
        $link_url = $button['url'];
        $link_title = $button['title'];
        $link_target = $button['target'] ? $button['target'] : '_self';
      ?>
      <p><a href="<?php echo esc_url( $link_url ); ?>" class="button secondary" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></p>
      <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; ?> 
      </div>
    </div>
  </div>
</section>

<section class="breadcrumbs">
  <div class="container">
  <?php if (function_exists('breadcrumbs')) breadcrumbs(); ?>
  </div>
</section>

<section class="filters">
  <div class="container">
    <?php get_template_part( 'inc/opportunity', 'filter' ); ?>
  </div>
</section>

<section class="archive">
  <div class="container">
    <div class="twelve columns">
      <div class="news_listing">
      <?php if ( have_posts() ) : while (have_posts()) : the_post();  ?>
        <?php get_template_part('inc/article-opportunity'); ?>
      <?php endwhile; ?>
      </div>
      <div class="twelve columns">
        <?php numeric_posts_nav(); ?>
      </div>
      <?php else : ?>
      <p>No resources found.</p>
      <?php endif; wp_reset_query(); ?>
    </div>
  </div>
</section>

<?php get_footer();  ?>