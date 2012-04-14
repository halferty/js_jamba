<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );
$scheme = $themecolor;
$cookie_prefix = "ts-";
if (isset($_SESSION[$cookie_prefix. 'scheme'])) {
	$scheme = $_SESSION[$cookie_prefix. 'scheme'];
} elseif (isset($_COOKIE[$cookie_prefix. 'scheme'])) {
	$scheme = $_COOKIE[$cookie_prefix. 'scheme'];
}
$thisurl = $_SERVER['PHP_SELF'] . rebuildQueryString();
function rebuildQueryString() {
  $ignores = array("scheme");
  if (!empty($_SERVER['QUERY_STRING'])) {
      $parts = explode("&", $_SERVER['QUERY_STRING']);
      $newParts = array();
      foreach ($parts as $val) {
          $val_parts = explode("=", $val);
          if (!in_array($val_parts[0], $ignores)) {
            array_push($newParts, $val);
          }
      }
      if (count($newParts) != 0) {
          $jamba = implode("&amp;", $newParts);
      } else {
          return "?";
      }
      return "?" . $jamba . "&amp;";
  } else {
      return "?";
  } 
}
?>