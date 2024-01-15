<?php // Home CTA
  $image = get_field('section_two_image');
  $title = get_field('section_two_title');
  $content = get_field('section_two_content');
  $buttonText = get_field('section_two_button_text');
  $buttonLink = get_field('section_two_button_link');
  
  $url = $image['url'];
  $size = 'featured-img';
  $thumb = $image['sizes'][ $size ];
  $width = $image['sizes'][ $size . '-width' ];
  $height = $image['sizes'][ $size . '-height' ];
?>

<section class="home_cta">
  <div class="container">
    <div class="image six columns">
      <img src="<?php echo esc_url($thumb); ?>" alt="<?php echo esc_attr($image['alt']); ?>" width="<?php echo $width; ?>" height="<?php echo $height; ?>"/>
    </div>
    <div class="content six columns">
      <h2><?php echo $title; ?></h2>
      <?php echo $content; ?>
      <a href="<?php echo $buttonLink; ?>" class="button primary"><?php echo $buttonText; ?></a>
    </div>
  </div>
</section>