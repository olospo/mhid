<?php 
if (have_rows('visual_menu')) {
  $row_count = 0;
  // Loop through the rows of data for a count
  while (have_rows('visual_menu')) {
    the_row();
    $row_count++;
  }
  $word = number_to_word($row_count); // Ensure number_to_word() is defined and working
}
?>
<section class="visual_heading">
  <div class="container">
    <h2><?php echo get_sub_field('visual_menu_title'); ?></h2>
    <?php echo get_sub_field('visual_menu_content'); ?>
  </div>
</section>

<section class="visual_section">
    <div class="container">
    <?php if( have_rows('visual_menu') ): ?>
      <div class="visual_menu <?php echo esc_attr($word); ?>"> <!-- Escaped the word to ensure safe output -->
      <?php while( have_rows('visual_menu') ): the_row(); 
        $image = get_sub_field('image');
        $title = get_sub_field('title');
        $desc = get_sub_field('description');
        $link = get_sub_field('link');
        $colour = get_sub_field('colour_scheme');
      ?>
      
        <div class="visual <?php echo esc_attr($colour); ?>"> <!-- Escaped the colour to ensure safe output -->
          <?php if ( !empty($link['url']) ): ?>
          <a href="<?php echo esc_url( $link['url'] ); ?>" class="visual-link">
          <div class="image">
          <?php if( !empty($image) ): 
            $image_url = $image['url']; // Get the image URL
            echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image['alt']) . '">'; // Display the image with alt text
          endif; ?>
          </div>
          <div class="content">
          <h3><?php echo $title; ?></h3>
          <?php echo $desc; ?>
          <span class="button primary filled"><?php echo esc_html( $link['title'] ); ?></span>
          </div>
          </a>
        </div>
      <?php endif; ?>
    <?php endwhile; ?>
    </div>
    <?php endif; ?>
</section>
