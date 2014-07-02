<article<?php print $attributes; ?>>
	<div class="zone product-top-row">
    	<?php
		if (!_is_context_active('mobile')) { 
			_top_left_twiins_product_block($node);
		}
//		kpr($title_field);
		global $language;
//		kpr($language);
		$title = !empty($title_field[$language->language]) ? $title_field[$language->language][0]['safe_value'] : $title_original;
		?>
        <div class="product-right product-top grid-8 omega">
            <header><h1<?= $title_attributes ?>><span class="title"><?= $title ?> &gt;</span> <span class="features">
			<?php  
				$feats = array();
				if (!empty($content['field_features_short']['#items'])) {
					foreach ($content['field_features_short']['#items'] as $k => $i) {
						$feats[] = $i['safe_value'];
					}
				}
				echo implode(" / ", $feats);
			?></span></h1></header>
             <div class="product-description">
             	<h2 class="block-title"><?= t('Description') ?></h2>
                <?= render($content['body']) ?>
                 <div class="product-description-image">
                    <?= render($content['uc_product_image']) ?>
                 </div>
             </div>
		</div>
    	<?php
		if (_is_context_active('mobile')) { 
			_top_left_twiins_product_block($node);
		}
		?>
    </div>

	<div class="zone product-bottom-row">
        <div class="product-left product-bottom grid-4 alpha">
            <h2  class="block-title"><?= t('Technical description') ?></h2>
            <div class="technical-description">
                <?php
                    if (!empty($content['field_manual']['#items'])) {
                        $url = file_create_url($content['field_manual']['#items'][0]['uri']);
                        echo "<a href=\"$url\" target=\"_blank\" class=\"user-manual\"><div>".t('User manual')."</div></a>";
                    };
//print_r(					$content['field_video_url']['#object']->field_video_url);
//print_r($language);
//print_r(empty($content['field_video_url']['#object']->field_video_url[$language->language]));
					try {
				
						if (!empty($content['field_video_url']['0']) and !empty($content['field_video_url']['#object']->field_video_url[$language->language])) {
							echo "<a href=\"".$content['field_video_url']['0']['#markup']."\" target=\"_blank\" class=\"video-manual\"><div >".t('Video instructions')."</div></a>";
						}
					}
					catch (Exception $e) {
					}
                    
                    if (!empty($content['field_technical_features']['#items'])) {
                        $content['field_technical_features']['#theme'] = 'item_list';
                        $content['field_technical_features']['#attributes'] = array();
                        $content['field_technical_features']['#title'] = '';
                        foreach ($content['field_technical_features']['#items'] as  $idx => $i) {
                            $content['field_technical_features']['#items'][$idx]['data'] = $i['safe_value'];
                        }
                        print render($content['field_technical_features']);
                    }
                                    
                ?>
            </div>
        </div>
        <div class="product-right product-bottom grid-8 omega">
            <h2  class="block-title"><?= t('Features') ?></h2>
            <?php
                    if (!empty($content['field_features']['#items'])) {
						$content['field_features2'] = array('#theme' => 'item_list', '#items' => array());
						$content['field_features3'] = array('#theme' => 'item_list', '#items' => array());
						
                        $content['field_features']['#theme'] = 'item_list';
                        $content['field_features']['#attributes'] = array();
                        $content['field_features']['#title'] = '';
						$count = 0;
                        foreach ($content['field_features']['#items'] as  $idx => $i) {
							$count += strlen($i['safe_value']) + 60;
						}
						$split_at = $count / 2;
						$count = 0;
                        foreach ($content['field_features']['#items'] as  $idx => $i) {
							$count += strlen($i['safe_value']) +60;
							if ($count > $split_at) {
	                            $content['field_features3']['#items'][]['data'] = $i['safe_value'];
							}
							else {
	                            $content['field_features2']['#items'][]['data'] = $i['safe_value'];
							}
                        }
                        print render($content['field_features2']);
						print render($content['field_features3']);
                    }
            ?>
        </div>
	</div>


</article>

<?php
function _top_left_twiins_product_block ($node) {
        echo '<div class="product-left product-top grid-4 alpha">';
        echo '<h2 class="block-title">'. t('Display, packaging and contents') .'</h2>';
        echo '<div class="product-slider">';
        $view = views_embed_view('product_kit_images', 'block_1', $node->nid);
        print $view;
        echo '</div>';
        echo '</div>';
}
?>