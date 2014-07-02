<?php
/**
 * @file
 * portfolio_type.features.inc
 */

/**
 * Implements hook_image_default_styles().
 */
function portfolio_type_image_default_styles() {
  $styles = array();

  // Exported image style: blog_teaser.
  $styles['blog_teaser'] = array(
    'name' => 'blog_teaser',
    'effects' => array(
      1 => array(
        'label' => 'Scale and crop',
        'help' => 'Scale and crop will maintain the aspect-ratio of the original image, then crop the larger dimension. This is most useful for creating perfectly square thumbnails without stretching the image.',
        'effect callback' => 'image_scale_and_crop_effect',
        'dimensions callback' => 'image_resize_dimensions',
        'form callback' => 'image_resize_form',
        'summary theme' => 'image_resize_summary',
        'module' => 'image',
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => '700',
          'height' => '320',
        ),
        'weight' => '1',
      ),
    ),
  );

  // Exported image style: portfolio_item.
  $styles['portfolio_item'] = array(
    'name' => 'portfolio_item',
    'effects' => array(
      2 => array(
        'label' => 'Scale and crop',
        'help' => 'Scale and crop will maintain the aspect-ratio of the original image, then crop the larger dimension. This is most useful for creating perfectly square thumbnails without stretching the image.',
        'effect callback' => 'image_scale_and_crop_effect',
        'dimensions callback' => 'image_resize_dimensions',
        'form callback' => 'image_resize_form',
        'summary theme' => 'image_resize_summary',
        'module' => 'image',
        'name' => 'image_scale_and_crop',
        'data' => array(
          'width' => '585',
          'height' => '431',
        ),
        'weight' => '1',
      ),
    ),
  );

  return $styles;
}

/**
 * Implements hook_node_info().
 */
function portfolio_type_node_info() {
  $items = array(
    'portfolio' => array(
      'name' => t('Portfolio'),
      'base' => 'node_content',
      'description' => t('Portfolio content.'),
      'has_title' => '1',
      'title_label' => t('Title'),
      'help' => '',
    ),
  );
  return $items;
}
