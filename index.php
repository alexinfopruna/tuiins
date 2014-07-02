<?php

/**
 * @file
 * The PHP page that serves all page requests on a Drupal installation.
 *
 * The routines here dispatch control to the appropriate handler, which then
 * prints the appropriate page.
 *
 * All Drupal code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 */


/**
 * Root directory of Drupal installation.
 */
define('DRUPAL_ROOT', getcwd());

$msg = 0;

require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);

//if ($user->uid == 0 and in_array($language->language, array('fr', 'it', 'de'))) {
//  drupal_set_message("Requested language will be soon available. Returning to english.", 'error');	
//  drupal_goto('', array('query' => 'language=en'));	
//}

menu_execute_active_handler();
