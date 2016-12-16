<?php

	if(isset($_POST['submit'])){

	$link = mysqli_connect('localhost', 'root', '', 'the_musicend');

	mysqli_query($link, "SET NAMES 'utf8'");

	$errors  = array();


	$name = mysqli_real_escape_string($link, $_POST['name']);
    $country = mysqli_real_escape_string($link, $_POST['country']);
    $genre = mysqli_real_escape_string($link, $_POST['genre']);
    $short_information = mysqli_real_escape_string($link, $_POST['short_information']);

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
     
	$admin = $_SESSION["admin"];
    $author_id = $_SESSION["id"];

	if(count($errors) == 0){

				mysqli_query($link,"INSERT INTO artist (author_id, name, country, genre, short_information, published) VALUES ('$author_id','$name', '$country', '$genre', '$short_information', '$admin')");

				echo "<script>alert('Артиста додано!');</script>";
			
	} 


     mysqli_close($link);
		
  	} 
 ?>






<link href="./css/login.css" rel="stylesheet" type='text/css' />


	<div align="center" class="caption">Додати нового артиста</div>
	<div class="border">
	<form method="post"> 
		<div> 
			<label for="name"> Ім'я:</label><br>
			<input type="text" maxlength="32" name="name" id="name" />  
			<p style = "color:#CD5555; font-size: 16px;">
			<?php 
				if(isset($errors['name'])) echo $errors['name'];
			?>
		</div> 
		<div> 
			<label for="country"> Країна:</label><br> 
			<input type="text" maxlength="64" name="country" id="country" /> 
			<p style = "color:#CD5555; font-size: 16px;">
			<?php 
				if(isset($errors['country'])) echo $errors['country'];
			?>
		</div>
		<div> 
			<label for="genre">Жанр:</label><br> 
			<input type="text" maxlength="32" name="genre" id="genre" /> 
			<p style = "color:#CD5555; font-size: 16px;">
			<?php 
				if(isset($errors['genre'])) echo $errors['genre'];
			?>
		</div>
		<div> 
			<label for="short_information"> Коротка інформація про артиста:</label><br> 
			<textarea name="short_information" id="short_information" cols="40" rows="5"></textarea> 
			<p style = "color:#CD5555; font-size: 16px;">
			<?php 
				if(isset($errors['short_information'])) echo $errors['short_information'];
			?>
		</div>
		
		<div> 
			<input type="submit" value="Додати" name="submit" id="button" /> 
		</div> 
	</form>
	</div>
</div>

