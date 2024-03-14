<?php 
$title  = get_sub_field('title');
$content = get_sub_field('content');
$button = get_sub_field('button');
?>
<section class="intro">
  <div class="container">
    <div class="twelve columns">
      <h2><?php echo $title; ?></h2>
      <?php echo $content; ?>
      <?php if( $button ): 
        $link_url = $button['url'];
        $link_title = $button['title'];
        $link_target = $button['target'] ? $button['target'] : '_self';
      ?>
      <p><a href="<?php echo esc_url( $link_url ); ?>" class="button primary" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a></p>
      <?php endif; ?>
    </div>
  </div>
</section>