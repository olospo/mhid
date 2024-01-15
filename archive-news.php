<?php /* News Archive */
get_header(); ?>

<?php if( have_rows('news','option') ): ?>
<?php while( have_rows('news','option') ): the_row(); 
  // Get sub field values.
  $title = get_sub_field('news_title');
  $desc = get_sub_field('news_description');
  $image = get_sub_field('news_background_image');
  $opacity = get_sub_field('news_overlay_opacity');
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

<section class="archive">
  <div class="container">
    <div class="twelve columns">
      <div class="news_listing">
          <?php if ( have_posts() ) : while (have_posts()) : the_post();  ?>
            <?php get_template_part('inc/article'); ?>
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
