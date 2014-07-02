<div class="portfolio-wrapper">
  <?php
  require_once 'portfolio_filter.tpl.php';
  ?>

  <?php if (!empty($nodes)): ?>
    <ul id="portfolio_items" class="clearfix">
      <?php
      foreach ($nodes as $node) :
        ?>
        <?php
        $image_full = '';
        $image_field = field_get_items('node', $node, 'field_image');
        if (!empty($image_field)) {
          $image_full = file_create_url($image_field[0]['uri']);
        }
        
        ?>
        <li data-id="id<?php print $node->nid; ?>" class="eight columns portfolio-item <?php print portfolio_format_terms('field_portfolio_category', $node); ?>" data-type="web-design">
          <?php if (!empty($image_field)): ?>
            <div class="picture">
              <?php
              $image_uri = $image_field[0]['uri'];
              //$image_url = file_create_url($image_uri);
              $style_name = 'portfolio_item';
              $node_url = url('node/' . $node->nid);
              $node_title = $node->title;
              ?>
              <a href="<?php print $node_url; ?>" title="<?php print $node->title; ?>">
                <span class="pic"><?php print theme('image_style', array('style_name' => $style_name, 'path' => $image_uri,)); ?><div class="img_overlay"></div></span>
                <h4><?php print $node_title; ?></h4>
              </a>

            <?php endif; ?>
        </li>
      <?php endforeach; ?>

    </ul>
  <?php endif; ?>

</div>
