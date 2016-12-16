<?php

 	$link = mysqli_connect('localhost', 'root', '', 'the_musicend');

    mysqli_query($link, "SET NAMES 'utf8'");

    $id = (int)$_GET["id"];

    $result = mysqli_query($link, "SELECT name, artist_id, country, genre, short_information, date FROM artist WHERE artist_id = $id"); 

    $row = mysqli_fetch_assoc($result);
    $artist_id = $row['artist_id'];

    if (isset($artist_id)) {
    	 echo '<div class="border"> <strong>Ім`я: </strong>'.$row['name'].' </br> 
                    <strong>Країна: </strong>'.$row['country'].' </br> 
                    <strong>Жанр: </strong>'.$row['genre'].' </br>
                    <strong>Коротка інформація: </strong>'.$row['short_information'].' </br>
                    <strong>Дата публікації: </strong>'.date("Y-m-d H:i:s", strtotime($row['date'])).'</br></br>
                </div>';
    }
    	else echo '<div class="border">Такого запису не існує!</div>';

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="./css/login.css" rel="stylesheet" type='text/css' />
	<link href="./css/artists_style.css" rel="stylesheet" type='text/css' /> 
</head>
<body>

</body>
</html>
