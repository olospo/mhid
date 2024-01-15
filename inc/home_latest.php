<?php $args = array( 'post_type' => 'post', 'posts_per_page' => '1'); query_posts($args); ?>
<?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
<section class="home_news">
  <div class="news_content">
    <div class="content">
      <h3>Latest update</h3>
      <span class="date"><?php the_date(); ?></span>
      <h4><?php the_title(); ?></h4>
      <a href="<?php the_permalink(); ?>" class="button secondary">Read More</a> <a href="<?php echo get_site_url(); ?>/updates" class="button filled white">View all updates</a>
    </div>
  </div>
  <div class="news_bg" style="background: url('<?php the_post_thumbnail_url( 'background-img' ); ?>') center center no-repeat; background-size: cover;"></div>
</section>
<?php endwhile; endif; wp_reset_query(); ?>