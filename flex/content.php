<?php 
$layout = get_sub_field('columns'); 

if( $layout == 'one' ) { // One Column. ?>
<section class="content_section one_column">
  <div class="container">
    <?php if( have_rows('column_one') ): while( have_rows('column_one') ): the_row(); // Content One
      $contentOne = get_sub_field('content_one');
    ?>
    <div class="twelve columns">
      <?php echo $contentOne; ?>
    </div>
    <?php endwhile; endif; ?>
  </div>
</section>

<?php } if( $layout == 'two' ) { // Two Column.?>
<section class="content_section two_columns">
  <div class="container">
    <?php if( have_rows('column_one') ): while( have_rows('column_one') ): the_row(); // Content One
      $contentOne = get_sub_field('content_one');
    ?>
    <div class="six columns">
      <?php echo $contentOne; ?>
    </div>
    <?php endwhile; endif; ?>
    <?php if( have_rows('column_two') ): while( have_rows('column_two') ): the_row(); // Content Two
      $contentTwo = get_sub_field('content_two');
    ?>
    <div class="six columns">
      <?php echo $contentTwo; ?>
    </div>
    <?php endwhile; endif; ?>
  </div>
</section>
<?php } if( $layout == 'sidebar' ) { // One column + sidebar. ?>
<section class="content_section two_columns">
  <div class="container">
    <?php if( have_rows('column_one') ): while( have_rows('column_one') ): the_row(); // Content One
      $contentOne = get_sub_field('content_one');
    ?>
    <div class="eight columns">
      <?php echo $contentOne; ?>
    </div>
    <?php endwhile; endif; ?>
    <?php get_template_part('inc/sidebar'); // Sidebar include. ?>
  </div>
</section>
<?php } if( $layout == 'sidebar-two' ) { // Two Columns + Sidebar. ?>
<section class="content_section two_columns_sidebar">
  <div class="container">
    <?php if( have_rows('column_one') ): while( have_rows('column_one') ): the_row(); // Content One
      $contentOne = get_sub_field('content_one');
    ?>
    <div class="four columns">
      <?php echo $contentOne; ?>
    </div>
    <?php endwhile; endif; ?>
    <?php if( have_rows('column_two') ): while( have_rows('column_two') ): the_row(); // Content Two
      $contentTwo = get_sub_field('content_two');
    ?>
    <div class="four columns">
      <?php echo $contentTwo; ?>
    </div>
    <?php endwhile; endif; ?>
    <?php get_template_part('inc/sidebar'); // Sidebar include. ?>
  </div>
</section>
<?php } ?>