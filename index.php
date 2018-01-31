<?php  

	require_once("config.php");

	echo"oi";
	$root = new Usuario();
	echo"oi2";
	$root->loadById(3);
	echo $root;

?>