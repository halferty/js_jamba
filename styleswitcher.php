<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );
$cookie_prefix = "ts-";
$cookie_time = time()+31536000;
if (isset($_GET['scheme'])) {
	$scheme = $_GET['scheme'];
	$_SESSION[$cookie_prefix. 'scheme'] = $scheme;
	setcookie ($cookie_prefix. 'scheme', $scheme, $cookie_time, '/', false);
}
?>
