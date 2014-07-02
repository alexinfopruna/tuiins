<?php
if (empty($title)) {
  $title = t('Recent Posts');
}
?>

<div class="row">
  <h2 class="sixteen columns title"><span><?php print $title; ?></span></h2>
  <div class="clear"></div>

  <div class="row">
    <div class="section_featured_services">
      <div class='carousel_arrows_bgr'></div>
      <ul id="featured_services_carousel">
        <?php foreach ($nodes as $node): ?>
          <?php $field_image = field_get_items('node', $node, 'field_image'); ?>
          <li class="four columns">
            <div class="pic">
              <a href="<?php print url('node/' . $node->nid); ?>"><?php print theme('image_style', array('style_name' => 'portfolio_item', 'path' => $field_image[0]['uri'])); ?><div class="img_overlay"></div></a>
            </div>
            <h4><a href="<?php print url('node/' . $node->nid); ?>"><?php print $node->title; ?></a></h4>
            <?php
            $body = field_get_items('node', $node, 'body');
            if (!empty($body)) {
              print custom_trim_text(array('max_length' => 60), $body[0]['value']);
            }
            ?>
          </li>
        <?php endforeach; ?>

      </ul>
    </div>
  </div>
</div>