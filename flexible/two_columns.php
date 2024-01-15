<?php // Two Columns
$image = get_sub_field('two_image');
$title = get_sub_field('two_title');
$content = get_sub_field('two_content');
$buttonText = get_sub_field('two_button_text');
$buttonLink = get_sub_field('two_button_link');
?>

<div class="flexible two_columns">
  <div class="content six columns">
    <h3><?php echo $title; ?></h3>
    <?php echo $content; ?>
    <?php if( $buttonText ): ?>
      <a href="<?php echo $buttonLink; ?>" class="button primary"><?php echo $buttonText; ?></a>
    <?php endif; ?>
  </div>
  <div class="image six columns">
    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
  </div>
</div>