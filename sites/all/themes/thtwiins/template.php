<?php

/**
 * @file
 * This file is empty by default because the base theme chain (Alpha & Omega) provides
 * all the basic functionality. However, in case you wish to customize the output that Drupal
 * generates through Alpha & Omega this file is a good place to do so.
 * 
 * Alpha comes with a neat solution for keeping this file as clean as possible while the code
 * for your subtheme grows. Please read the README.txt in the /preprocess and /process subfolders
 * for more information on this topic.
 */
 
//function thtwiins_links__locale_block(&$vars) {
//	$cont = "";
//	foreach ($vars['links'] as $k => $v) {
//		$vars['links'][$k]['title'] = $k; 
//	}
//	return var_export($vars, TRUE);
//}

//function thtwiins_preprocess_block(&$vars) {
////	kpr($vars);
//}

function thtwiins_preprocess_page(&$vars) {
	if (drupal_is_front_page()) {
		drupal_add_js(drupal_get_path('theme', 'thtwiins')."/extra.js", array('type'=>'file', 'scope'=>'footer','weight' => 60));
	}	
}

function thtwiins_preprocess_field(&$variables){
    if ($variables['element']['#field_name']=="field_compatibilidad"){
        $tid=$variables['element']['#items'][0]['tid'];
        $variables['classes_array'][]="compatibilidad-".$tid;
    //dsm($variables); 
    unset($variables['items'][0]['#type']);
   if (isset($variables['element']['#object']->field_compatibilidad['und']))  
       $variables['items'][0]['#markup']=$variables['element']['#object']->field_compatibilidad['und'][0]['taxonomy_term']->description;
        
   else 
       $variables['items'][0]['#markup']=$variables['element']['#object']->field_compatibilidad[0]['taxonomy_term']->description;
       
   /*
    //$field_language = field_language('node', $node, 'field_charity_author');  
 
    
else
        $variables['items'][0]['#markup']=$variables['element']['#object']->field_compatibilidad[0]['taxonomy_term']->description;
*/
//$variables['element']['#object']->field_compatibilidad['und'][0]['taxonomy_term']->name_original="AKAAA";
//['element']['#object']->field_compatibilidad['und'][0]['taxonomy_term']->description
//['element']['#object']->field_compatibilidad['und'][0]['taxonomy_term']->description_field['und']['0']['value'];
    }
}

/*
function thtwiins_field__field_compatibilidad(&$variables){
    $tid=$variables['element']['#items'][0]['tid'];
    $variables['classes_array'][]="compatibilitat-".$tid;
    //dsm($variables['classes_array']);
    
    $output = '';

  // Render the label, if it's not hidden.
  if (!$variables['label_hidden']) {
    $output .= '<div class="field-label"' . $variables['title_attributes'] . '>' . $variables['label'] . ':&nbsp;</div>';
  }

  // Render the items.
  $output .= '<div class="field-items"' . $variables['content_attributes'] . '>';
  foreach ($variables['items'] as $delta => $item) {
    $classes = 'field-item ' . ($delta % 2 ? 'odd' : 'even');
    $output .= '<div class="' . $classes . '"' . $variables['item_attributes'][$delta] . '>' . drupal_render($item) . '</div>';
  }
  $output .= '</div>';

  // Render the top-level DIV.
  $output = '<div class="' . $variables['classes'] . '"' . $variables['attributes'] . '>' . $output . '</div>';

  return $output;
    
    
    
    //dsm($vars['element']['#items'][0]['tid']);
}
*/