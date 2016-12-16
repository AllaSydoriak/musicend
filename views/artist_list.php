

<!DOCTYPE html>
<html>
<head>
    <title>Виконавці</title>
    <meta charset="utf-8">
    <link href="./css/artists_style.css" rel="stylesheet" type='text/css' /> 
</head>
<body>
    <?php

    $link = mysqli_connect('localhost', 'root', '', 'the_musicend');

    mysqli_query($link, "SET NAMES 'utf8'");

    $count = 3;
    $page = (int)$_GET['page'];
    $shift = $count * ($page - 1);
    $result = mysqli_query($link, "SELECT COUNT(*) FROM artist WHERE published=1");  
    $posts = mysqli_fetch_array($result);
    $total = ceil($posts[0]/$count); 

    $result_set = mysqli_query($link, "SELECT * FROM artist WHERE published = 1 ORDER BY date DESC LIMIT $shift, $count");
  
    if (isset($_SESSION["admin"])) $admin = $_SESSION["admin"];

    while($row = mysqli_fetch_assoc($result_set)){

        echo '<div class="border"> <strong>Ім`я :</strong>'.$row['name'].' </br> 
                    <strong>Країна: </strong>'.$row['country'].' </br> 
                    <strong>Жанр: </strong>'.$row['genre'].' </br>
                    <strong>Коротка інформація: </strong>'.$row['short_information'].' </br>
                    <strong>Дата публікації: </strong>'.date("Y-m-d H:i:s", strtotime($row['date'])).'</br></br>
                    ';
                echo '<div class="admin-row">
                    <a href="?action=view_artist&id='.$row['artist_id'].'">Переглянути</a>
                </div>';

        if(isset($admin)&&($admin == 1)) echo '<div class="admin-row">
                <a href="?action=update_artist&id='.$row['artist_id'].'">Редагувати</a>
                <a href="?action=delete_artist&id='.$row['artist_id'].'" onclick="return confirm(\'Ви впевнені?\')">Видалити</a>
                </div> ';

        echo '</div>';
    }

    echo '<div class="border-pages">';
    
    if ($page != 1) $pervpage = '<a class="button" href= ./?action=artist_list&page=1> << </a> 
                               <a class="button" href= ./?action=artist_list&page='. ($page - 1) .'> < </a> '; 

    if ($page != $total) $nextpage = '<a class="button" href= ./?action=artist_list&page='. ($page + 1) .'> > </a> 
                                   <a class="button" href= ./?action=artist_list&page=' .$total. '> >> </a>'; 


    if($page - 2 > 0) $page2left = '<a class="button" href= ./?action=artist_list&page='. ($page - 2) .'>'. ($page - 2) .'</a>  '; 
    if($page - 1 > 0) $page1left = '<a class="button" href= ./?action=artist_list&page='. ($page - 1) .'>'. ($page - 1) .'</a> | '; 
    if($page + 2 <= $total) $page2right = '<a class="button" href= ./?action=artist_list&page='. ($page + 2) .'>'. ($page + 2) .'</a> '; 
    if($page + 1 <= $total) $page1right = ' | <a class="button" href= ./?action=artist_list&page='. ($page + 1) .'>'. ($page + 1) .'</a> '; 

    $menu = '';
 
    if (isset($pervpage)) $menu = $menu.$pervpage;
    if (isset($page2left)) $menu = $menu.$page2left;
    if (isset($page1left)) $menu = $menu.$page1left;
    if (isset($page)) $menu = $menu.$page;
    if (isset($page1right)) $menu = $menu.$page1right;
    if (isset($page2right)) $menu = $menu.$page2right;
    if (isset($nextpage)) $menu = $menu.$nextpage;

    echo $menu; 

    echo '</div>'
 
?>


</body>
</html> 
