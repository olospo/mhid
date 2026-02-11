<article class="twelve columns opportunity-item">

  <?php
  // --- Expiry + badges ---
  $expires_raw = get_field('expires_on'); // ideally Ymd e.g. 20260205
  $today       = (int) current_time('Ymd');

  $expires_ymd = null;
  $days_left   = null;

  if ($expires_raw) {
    // If stored as Ymd, this is already numeric-ish. Cast to int.
    $expires_ymd = (int) preg_replace('/\D/', '', (string) $expires_raw);

    // Calculate days left (using DateTime for proper day boundaries)
    $dt_today   = new DateTime(current_time('Y-m-d'));
    $dt_expires = DateTime::createFromFormat('Ymd', (string) $expires_ymd);

    if ($dt_expires) {
      $diff      = $dt_today->diff($dt_expires);
      $days_left = (int) $diff->format('%r%a'); // negative if expired
    }
  }

  $is_past_view = (bool) get_query_var('opportunity_past'); // from your /opportunities/past/ rewrite
  ?>

  <?php if ( has_post_thumbnail() ) : ?>
    <div class="thumb">
      <a href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail('large-thumb'); ?>
      </a>
    </div>
  <?php endif; ?>

  <div class="content">

    <h3>
      <a href="<?php the_permalink(); ?>">
        <?php the_title(); ?>
      </a>
    </h3>

    <?php if ($expires_ymd) : ?>
      <div class="meta">
        <span class="expires">
          <?php
            $dt_expires_display = DateTime::createFromFormat('Ymd', (string) $expires_ymd);
    
            if ($dt_expires_display) {
    
              if ($days_left !== null && $days_left < 0) {
                echo 'Closed on: ' . esc_html($dt_expires_display->format('jS M Y'));
              } else {
                echo esc_html($dt_expires_display->format('jS M Y'));
              }
    
            }
          ?>
        </span>
    
        <?php
        // Closing today badge
        if ($days_left === 0 && ! $is_past_view) : ?>
          <span class="badge closing-today">
            Closing today
          </span>
        <?php endif; ?>
    
        <?php
        // Closing soon badge (1–7 days)
        if ($days_left !== null && $days_left >= 1 && $days_left <= 7 && ! $is_past_view) : ?>
          <span class="badge closing-soon">
            Closing in <?php echo (int)$days_left . ' ' . ($days_left === 1 ? 'day' : 'days'); ?>
          </span>
        <?php endif; ?>
    
        <?php
        // Expired badge
        if ($is_past_view && $days_left !== null && $days_left < 0) : ?>
          <span class="badge expired">
            Expired
          </span>
        <?php endif; ?>
    
      </div>
    <?php endif; ?>



    <?php
    if ( get_post_type() === 'opportunity' ) :

      // Topic
      $topics = get_the_terms( get_the_ID(), 'opportunity-topic' );
      if ( $topics && ! is_wp_error( $topics ) ) : ?>
        <div class="topic">
          <?php foreach ( $topics as $term ) :
            $filter_url = add_query_arg(
              'opportunity-topic',
              $term->slug,
              get_post_type_archive_link('opportunity')
            );
          ?>
            <a href="<?php echo esc_url($filter_url); ?>" class="topic-link">
              <?php echo esc_html($term->name); ?>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif;

      // Age
      $ages = get_the_terms( get_the_ID(), 'opportunity-age' );
      if ( $ages && ! is_wp_error( $ages ) ) : ?>
        <div class="age">
          <?php foreach ( $ages as $term ) :
            $filter_url = add_query_arg(
              'opportunity-age',
              $term->slug,
              get_post_type_archive_link('opportunity')
            );
          ?>
            <a href="<?php echo esc_url($filter_url); ?>" class="age-link">
              <?php echo esc_html($term->name); ?>
            </a>
          <?php endforeach; ?>
        </div>
      <?php endif;

    endif;
    ?>

    <?php the_excerpt(); ?>

    <a href="<?php the_permalink(); ?>" class="button primary">
      Read more
    </a>

  </div>
</article>
