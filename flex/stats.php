<?php if (have_rows('stat')) {
  $row_count = 0;
  // Loop through the rows of data for a count
  while (have_rows('stat')) {
    the_row();
    $row_count++;
  }
}
$word = number_to_word($row_count);

if( have_rows('stat') ): ?>
<section class="stat_section">
  <div class="container">
    <div class="stats <?php echo $word; ?>">
    <?php while( have_rows('stat') ): the_row(); 
      $unit = get_sub_field('unit');
      $unit_extra = get_sub_field('unit_extra');
      $prepost = get_sub_field('postfix_or_prefix');
      $desc = get_sub_field('description');
      $colour = get_sub_field('stat_color');
    ?>
      <div class="stat <?php echo $colour; ?>">
        <span class="unit" data-count="<?php echo $unit; ?>" <?php if ($prepost) { ?> data-<?php echo $prepost ;?>="<?php echo $unit_extra; ?>" <?php } ?>><?php echo $unit; ?></span>
        <span class="description"><?php echo $desc; ?></span>
      </div>
    <?php endwhile; ?>
    </div>
  </div>
</section>
<?php endif; ?>