<?php


if (file_exists( __DIR__.'/charts/index.php')) {
	require_once __DIR__.'/charts/index.php';
}
else{
	throw new Exception(__DIR__.'/charts/index.php not found');
}
?>



