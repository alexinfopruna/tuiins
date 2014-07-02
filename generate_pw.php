<?php
define('DRUPAL_ROOT', getcwd());
require_once DRUPAL_ROOT . '/includes/bootstrap.inc';
drupal_bootstrap(DRUPAL_BOOTSTRAP_FULL);
require_once DRUPAL_ROOT . '/includes/password.inc';
if (isset($_GET['pass']) && !empty($_GET['pass'])) {
  print  user_hash_password($_GET['pass']);
}
else {
  die('Retry with ?pass=PASSWORD set in the URL');
}
?>