<?php
$terms = array();
$vid = NULL;
$vid_machine_name = 'portfolio_categories';
$vocabulary = taxonomy_vocabulary_machine_name_load($vid_machine_name);
if (!empty($vocabulary->vid)) {
  $vid = $vocabulary->vid;
}
if (!empty($vid)) {
  $terms = taxonomy_get_tree($vid);
}
?>
<?php if (!empty($terms)): ?>
  <div id="portfolio_filter" class="option-set portfolio_filter clearfix" data-option-key="filter">
    <span><?php print t('Filter'); ?>:</span>
    <div data-option-value="*" class="filter-item current"><?php print t('All'); ?></div>
    <?php foreach ($terms as $term): ?> 
      <div class="filter-item" data-option-value=".tid-<?php print $term->tid; ?>"><?php print $term->name; ?></div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>