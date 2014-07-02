<?php

function portfolio_default_page($type = NULL) {


    global $user;

    $default_portfolio = $type;
    if (empty($type)) {
        $default_portfolio = theme_get_setting('default_portfolio', 'aqua');
    }



    $portfolio_type_arr = array('4c', '3c', '2c', '1c');
    $build = array();



    if (in_array($default_portfolio, $portfolio_type_arr)) {


        $query = db_select('node', 'n')->extend('PagerDefault');
        $nids = $query
                ->fields('n', array('nid', 'sticky', 'created'))
                ->condition('type', 'portfolio')
                ->condition('status', 1)
                ->orderBy('sticky', 'DESC')
                ->orderBy('created', 'DESC')
                ->limit(theme_get_setting('default_nodes_portfolio', 'aqua'))
                ->addTag('node_access')
                ->execute()
                ->fetchCol();

        if (!empty($nids)) {
            $nodes = node_load_multiple($nids);
            $build += array('nodes' => array(
                    '#theme' => 'portfolio_' . $default_portfolio,
                    '#nodes' => $nodes,
                    )); //theme('portfolio_' . $default_portfolio, array('nodes' => $nodes));
            $build['pager'] = array(
                '#theme' => 'pager',
                '#weight' => 5,
            );
        } else {
            drupal_set_message(t('No project entries have been created.'));
        }
    } else {

        drupal_set_message(t('No project entries have been created.'));
    }

    return $build;
}