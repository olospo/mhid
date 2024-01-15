<?php // Home Framework
  $title = get_field('section_one_title');
  $content = get_field('section_one_content');
  $buttonText = get_field('section_one_button_text');
  $buttonLink = get_field('section_one_button_link');
  $video = get_field('section_one_video');
?>

<section class="home_framework">
  <div class="container">
    <div class="video six columns">
      <?php echo $video; ?>
    </div>
    <div class="content six columns">
      <h2><?php echo $title; ?></h2>
      <?php echo $content; ?>
      <a href="<?php echo $buttonLink ?>" class="button primary"><?php echo $buttonText; ?></a>
    </div>
  </div>
</section>