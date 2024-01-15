<?php /* Category */
get_header(); ?>

<section class="hero small">
  <div class="container">
    <div class="twelve columns">
      <div class="content">
        <h1><?php single_cat_title(); ?></h1>
      </div>
    </div>
  </div>
</section>

<section class="news">
  <div class="container">
    <div class="twelve columns">
      <div class="content">
        <?php if ( have_posts() ) : while (have_posts()) : the_post(); ?>
        <article class="standard one-third column">
          <div class="item_image">
            <a href="<?php the_permalink(); ?>">
              <img src="<?php the_post_thumbnail_url( 'featured-img' ); ?>" >
            </a>
          </div>
          <div class="item_content">
            <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <div class="content">
              <p class="date">Posted on <?php the_time('d/m/y'); ?></p>
              <?php the_excerpt(); ?>
            </div>
          </div>
        </article>
      <?php endwhile; ?>
      </div>
      <div class="content">
        <div class="sixteen columns">
          <?php numeric_posts_nav(); ?>
        </div>
      </div>
        <?php else : ?>
        <!-- No posts found -->
        <?php endif; wp_reset_query(); ?>
    </div>
  </div>
</section>

<?php get_footer(); ?>