
    <link href="./css/login.css" rel="stylesheet" type='text/css' />
    <link href="./css/artists_style.css" rel="stylesheet" type='text/css' /> 

<?php

    $link = mysqli_connect('localhost', 'root', '', 'the_musicend');

    mysqli_query($link, "SET NAMES 'utf8'");

    $id = (int) $_GET["id"]; 

    $result = mysqli_query($link, "SELECT name, artist_id FROM artist WHERE artist_id = $id");

    $row = mysqli_fetch_assoc($result);
    $artist_id = $row['artist_id'];

    if ( !is_null($row) ) { 
        mysqli_query($link, "DELETE FROM artist WHERE artist_id = $id");
        echo '<div class="border">Запис видалено!</div>';
    }
    else echo '<div class="border">Такого запису не існує!</div>';

?>

