
<?php if( have_rows('accordion') ): ?>
<div class="flexible accordion">
  <?php while( have_rows('accordion') ): the_row(); 
    $title = get_sub_field('title');
    $content = get_sub_field('content');
  ?>
  <article class="accordionItem close">
    <div class="title accordionItemHeading">
      <?php echo $title; ?>
      <span></span>
      <span></span>
    </div>
    <div class="accordionItemContent">
      <?php echo $content; ?>
    </div>
  </article>
  <?php endwhile; ?>
</div>
<?php endif; ?>