<article class="one-third column">
  <a href="<?php the_permalink(); ?>">
  <div class="image">
    <img src="<?php the_post_thumbnail_url( 'featured-img' ); ?>" />
  </div>
  </a>
  <div class="content">
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <span class="date"><?php the_time("F j, Y"); ?></span>
    <?php the_excerpt(); ?>
    <!-- <a href="<?php the_permalink(); ?>" class="button primary">Read more</a> -->
  </div>
</article>