<?php 
$layout = get_sub_field('columns'); 

if( $layout == 'one' ) { ?>
<section class="content_section one_column">
  <div class="container">
    <?php if( have_rows('column_one') ): while( have_rows('column_one') ): the_row(); // Content
    $contentOne = get_sub_field('content_one');
    ?>
    <div class="twelve columns">
      <?php echo $contentOne; ?>
    </div>
    <?php endwhile; endif; ?>
  </div>
</section>

<?php } if( $layout == 'two' ) { ?>
<section class="content_section two_columns">
  <div class="container">
    <?php if( have_rows('column_one') ): while( have_rows('column_one') ): the_row(); // Content
    $contentOne = get_sub_field('content_one');
    ?>
    <div class="six columns">
      <?php echo $contentOne; ?>
    </div>
    <?php endwhile; endif; ?>
    <?php if( have_rows('column_two') ): while( have_rows('column_two') ): the_row(); // Content
    $contentTwo = get_sub_field('content_two');
    ?>
    <div class="six columns">
      <?php echo $contentTwo; ?>
    </div>
    <?php endwhile; endif; ?>
  </div>
</section>
<?php } if( $layout == 'sidebar' ) { ?>
<section class="content_section two_columns">
  <div class="container">
    <?php if( have_rows('column_one') ): while( have_rows('column_one') ): the_row(); // Content
    $contentOne = get_sub_field('content_one');
    ?>
    <div class="eight columns">
      <?php echo $contentOne; ?>
    </div>
    <?php endwhile; endif; ?>
    <aside class="four columns">
      <h3>Sidebar</h3>
      <p>Holding content, sidebar will go here</p>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    </div>
  </div>
</section>
<?php } ?>