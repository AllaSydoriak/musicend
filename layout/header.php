<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"/>
	<title> The Musicend </title>
	<link href="./css/style.css" rel="stylesheet" type='text/css' />
</head>
<body>
	<div >
		<header>
			<a href="index.php"><img src="./img/QkCecISpLoc.gif" width="100%" height="100%"></a>
			<div class="menu">
	        <ul id="navbar">
	        	<li><a href="?action=main">Головна</a></li>
	        	<li><a href="?action=about">Про сайт</a></li>
	        	<li><a href="?action=artist_list&page=1">Виконавці</a></li>
	            <!--<li><a href="#">Обрати жанр</a>
	                <ul>
	                    <li><a href="#">Поп</a></li>
	                    <li><a href="#">Рок</a></li>
						<li><a href="#">Хіп-Хоп</a></li>
						<li><a href="#">R&B</a></li>
						<li><a href="#">Інді</a></li>
						<li><a href="#">Класика</a></li>
						<li><a href="#">Метал</a></li>
						<li><a href="#">Саунтреки</a></li>
	                </ul>
	            </li>-->

				<?php if(isset($_SESSION['login']) && $_SESSION['id']>0 ) { ?>
						<li><a href="?action=create_artist">Додати артиста</a></li>
                        <li><a href="?action=logout"> Вихід</a></li>
                        <?php } else{ ?>
                        <li><a href="?action=login"> Вхід</a></li>
                        <li><a href="?action=registration">Реєстрація</a></li>
                 <?php } ?>

	        </ul>
	    	</div>
		</header>
	</div>
	
	<div class="content" >