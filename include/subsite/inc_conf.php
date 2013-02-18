<?php 

	$server_host = explode('.', $_SERVER['HTTP_HOST']);
	$title = strtolower($server_host[0]);
	if (strtolower($title) == strtolower("www")) {
		$title = strtolower($server_host[1]);
	}

	
?>
