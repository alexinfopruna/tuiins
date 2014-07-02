<?php
if (empty($title)) {
  $title = t('Recent Work');
}
?>
<div class="row">
  <h2 class="title sixteen columns"><span><?php print $title; ?></span></h2>
  <div class="clear"></div>
  <div class="half_padded_block carousel_section">
    <div class='carousel_arrows_bgr'></div>
    <ul id="portfolio_carousel">
      <?php foreach ($nodes as $node): ?>
        <?php $field_image = field_get_items('node', $node, 'field_image'); ?>
        <li class="four columns portfolio_item">
          <a href="<?php print url('node/' . $node->nid); ?>" title="<?php print $node->title; ?>">
            <span class="pic"><?php print theme('image_style', array('style_name' => 'portfolio_item', 'path' => $field_image[0]['uri'])); ?><div class="img_overlay"></div></span>
            <h5><?php print $node->title; ?></h5>
          </a>
        </li>
      <?php endforeach; ?>

    </ul>
  </div>
</div>
