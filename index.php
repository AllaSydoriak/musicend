<?php
	session_start();
	require_once('./layout/header.php');
?>

<?php
if(isset($_GET["action"]) && file_exists('./views/' . $_GET["action"] . '.php')){ 
	include_once('./views/' . $_GET["action"] . '.php'); 
	} 
else include_once("views/main.php"); 
?>

<?php
	require_once('./layout/footer.php')
?>