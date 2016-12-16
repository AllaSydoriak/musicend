<?php
	if (!empty($_SESSION['login']) && $_SESSION['login']){
		
		session_destroy(); 
    	header("Location: ?action=main");
	}
?>
