<?php /* Template Name: Educational Resources */
$sub = get_field('sub_title');
get_header(); ?>
<?php while ( have_posts() ) : the_post(); ?>

<section class="hero single">
  <div class="container">
    <div class="content ten columns">
      <h1><?php the_title(); ?></h1>
     <?php if ($sub): ?><p><?php echo $sub; ?></p><?php endif; ?>
    </div>
  </div>  
</section>

<section class="archive">
  <div class="container">
    <div class="twelve columns">
      <div class="breadcrumbs">
        <?php if (function_exists('breadcrumbs')) breadcrumbs(); ?>
      </div>
      <?php the_content(); ?>
      <div class="news_listing">
          <?php 
            query_posts(array( 
              'post_type' => 'resource',
              'showposts' => -1,
            ));  
          ?>
            <?php if ( have_posts() ) : while (have_posts()) : the_post();  ?>
            
            <article class="one-third column">
              <a href="<?php the_permalink(); ?>">
              <div class="image">
                <img src="<?php the_post_thumbnail_url( 'featured-img' ); ?>" />
              </div>
              </a>
              <div class="content">
                <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <?php the_excerpt(); ?>
                <!-- <a href="<?php the_permalink(); ?>" class="button primary">Read more</a> -->
              </div>
            </article>
      
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

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>