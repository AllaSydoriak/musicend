<?php

	$link = mysqli_connect('localhost', 'root', '', 'the_musicend');
	mysqli_query($link, "SET NAMES 'utf8'");
	$id = (int)$_GET["id"];

	$result = mysqli_query($link, "SELECT name, artist_id, country, genre, short_information, published FROM artist WHERE artist_id = $id"); 
	

	if(mysqli_num_rows($result) != 0){
	
	$row = mysqli_fetch_assoc($result);

	if(isset($_POST['submit'])){

	$errors  = array();

  	$name = mysqli_real_escape_string($link, $_POST['name']);
    $country = mysqli_real_escape_string($link, $_POST['country']);
    $genre = mysqli_real_escape_string($link, $_POST['genre']);
    $short_information = mysqli_real_escape_string($link, $_POST['short_information']);
    $published = mysqli_real_escape_string($link, $_POST['status']);

 	$patternForName = '/^[A-ZА-ЯІ][А-ЯA-Zшща-яіa-z0-9\s_-]{2,32}$/iu';
    $patternForCountry = '/^[A-ZА-ЯІ][а-яіa-zшї\s]{2,64}$/iu';
    $patternForGenre = '/^[A-ZА-ЯІ][А-ЯA-Zшща-яіa-z-\s]{2,32}$/iu';

    if(empty($name)){
    	$errors['name'] = "Поле 'ім'я' обовязкове для заповнення<br>";		
    }
        else if(strlen($name) < 2){
            $errors['name'] = "Поле логін має містити щонайменше 2 символи<br>";
        }
          else if(!preg_match($patternForName, $name)){
              $errors['name'] = "Ім'я має починатися з великої літери і містити лише латинські та кириличні літери (великі та малі), нижнє підкреслення та дефіс<br>";
          }

    if(empty($country)){
        $errors['country'] = "Поле 'країна' обов'язкове для заповнення<br>";  
    }
        else if(strlen($country) < 2){
            $errors['country'] = "Країна має містити щонайменше 2 символи<br>";
        }
            else if(!preg_match($patternForCountry,$country)){
              $errors['country'] = "Країна має починатися з великої літери і містити лише латинські та кириличні літери <br>";
            }

     if(empty($genre)){
        $errors['genre'] = "Поле 'жанр' обов'язкове для заповнення<br>";  
    	}
        else if(strlen($genre) < 2){
            $errors['genre'] = "Жанр має містити щонайменше 2 символи<br>";
        }
            else if(!preg_match($patternForGenre,$genre)){
              $errors['genre'] = "Жанр має починатися з великої літери і містити лише латинські та кириличні літери та дефіс <br>";
            }

    if(empty($short_information)){
        $errors['short_information'] = "Поле 'коротка інформація про артиста' обов'язкове для заповнення<br>";  
    }
        else if(strlen($short_information) < 7){
            $errors['short_information'] = "Це поле має містити щонайменше 10 символи<br>";
        }

    if( $published == ""){
        $errors['short_information'] = "Поле 'Статус' обов'язкове для заповнення<br>";  
    }
            
     
	if(count($errors) == 0){

		$query = "UPDATE artist SET name='".$name."', country='".$country."', genre='".$genre."', short_information='".$short_information."', published='".$published."' WHERE artist_id='".$id."'";
        $new_result = mysqli_query($link, $query);

        if ($new_result) echo "<script>alert('Запис оновлено!');</script>";

	} 

     mysqli_close($link);
		
  	} 
}
	else echo '<div class="border">Такого запису не існує!</div>';

	
	
 ?>


<link href="./css/login.css" rel="stylesheet" type='text/css' />


	<div align="center" class="caption">Редагувати інформацію</div>
	<div class="border">
	<form method="post"> 
		<div> 
			<label for="name"> Ім'я:</label><br>
			<input type="text" maxlength="32" name="name" id="name" value="<?php echo $row['name']; ?>" />  
			<p style = "color:#CD5555; font-size: 16px;">
			<?php 
				if(isset($errors['name'])) echo $errors['name'];
			?>
		</div> 
		<div> 
			<label for="country"> Країна:</label><br> 
			<input type="text" maxlength="64" name="country" id="country" value="<?php echo $row['country']; ?>" /> 
			<p style = "color:#CD5555; font-size: 16px;">
			<?php 
				if(isset($errors['country'])) echo $errors['country'];
			?>
		</div>
		<div> 
			<label for="genre">Жанр:</label><br> 
			<input type="text" maxlength="32" name="genre" id="genre" value="<?php echo $row['genre']; ?>" /> 
			<p style = "color:#CD5555; font-size: 16px;">
			<?php 
				if(isset($errors['genre'])) echo $errors['genre'];
			?>
		</div>
		<div> 
			<label for="short_information"> Коротка інформація про артиста:</label><br> 
			<textarea name="short_information" id="short_information" cols="40" rows="5" ><?php echo $row['short_information']; ?></textarea> 
			<p style = "color:#CD5555; font-size: 16px;">
			<?php 
				if(isset($errors['short_information'])) echo $errors['short_information'];
			?>
		</div>
		<div> 
			<label for="status"> Статус:</label><br> 
			<input type="text" name="status" id="status" maxlength="1" value="<?php echo $row['published']; ?>" />
			<p style = "color:#CD5555; font-size: 16px;">
			<?php 
				if(isset($errors['published'])) echo $errors['published'];
			?>
		</div>
		<div> 
			<input type="submit" value="Редагувати" name="submit" id="button" /> 
		</div> 
	</form>
	</div>
</div>

