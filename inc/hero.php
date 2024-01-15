<?php // Hero
  $title = get_field('title');
  $content = get_field('content');
  $image = get_field('background_image');
  $buttonText = get_field('button_text');
  $buttonLink = get_field('button_link');
?>

<section class="home hero">
  <div class="background" style="background: linear-gradient(rgba(0, 0, 0, 0.00), rgba(0, 0, 0, 0.00)), url(' <?php echo $image['url']; ?> ') center center no-repeat; background-size: cover;"></div>
  <div class="float">
    <div class="container">
      <div class="content ten columns">
      <h1><?php echo $title; ?></h1>
      <?php echo $content; ?>
      <?php if ( $buttonText ): ?>
        <a href="<?php echo $buttonLink; ?>" class="button secondary"><?php echo $buttonText; ?></a> 
      <?php endif; ?>
      </div>
    </div>
  </div>
</section>