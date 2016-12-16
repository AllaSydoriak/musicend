<?php

	
	$link = mysqli_connect('localhost', 'root', '', 'the_musicend');

	mysqli_query($link, "SET NAMES 'utf8'");

	$errors  = array();

	if (isset($_POST['submit'])){

	$login = $_POST["login"]; 
 	$password = $_POST['password']; 
  	$repeated_password = $_POST['repeated_password'];
  	$email = $_POST['email'];
  	$date_of_birth = $_POST['date_of_birth'];

 	$patternForLogin = '/^[a-z0-9_-]{4,255}$/i';
    $patternForPassword = '/^[a-z0-9]{7,255}$/i';
    $patternForEmail = '/^[a-z0-9_\.-]+@[a-z0-9_-]+\.[a-z]{2,3}$/i';
    $patternForDate1 = '/^(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(19|20)\d\d$/';
    $patternForDate2 = '/^(19|20)\d\d-(0[1-9]|1[012])-(0[1-9]|[12][0-9]|3[01])$/';
    $patternForDate3 = '/^(0[1-9]|1[012])\/(0[1-9]|[12][0-9]|3[01])\/(19|20)\d\d$/';

    if(empty($login)){
    	$errors['login'] = "Поле логін обовязкове для заповнення";		
    }
        else if(strlen($login) < 4){
            $errors['login'] = "Поле логін має містити щонайменше 4 символи<br>";
        }
          else if(!preg_match($patternForLogin, $login)){
              $errors['login'] = "Логін має містити лише латинські та кириличні літери (великі та малі), цифри, нижнє підкреслення та дефіс<br>";
          }

    if(empty($password)){
        $errors['password'] = "Поле 'пароль' обов'язкове для заповнення<br>";  
    }
        else if(strlen($password) < 7){
            $errors['password'] = "Пароль має містити щонайменше 7 символи<br>";
        }
            else if(!preg_match($patternForPassword,$password)){
              $errors['password'] = "Пароль обов’язково має містити великі та малі літери, а також цифри<br>";
            }


    if(empty($repeated_password)){
          $errors['repeated_password'] = "Введіть повторний парль<br>";
      }
        else if(strcmp($password,$repeated_password) != 0){
          $errors['repeated_password'] = "Паролі не співпадають<br>";
        }

   	if(empty($email)){
          $errors['email'] = "Поле 'e-mail' обов'язкове для заповнення<br>";
      }
        else if(!preg_match($patternForEmail,$email)){
            $errors['email'] = "Електронна адреса має містити символ '@' <br>";
      }

    if (empty($date_of_birth)) {
          $errors['date_of_birth'] = "Поле 'дата народження' обов'язкове для заповнення<br>";
      }
        else if( !preg_match($patternForDate1,$date_of_birth) && 
        	!preg_match($patternForDate2,$date_of_birth) &&    
        	!preg_match($patternForDate3,$date_of_birth)){
            $errors['date_of_birth'] = "Вказаний неправильний формат дати<br>";
      	} 
     
	
	if(count($errors) == 0){
				$password = password_hash($_POST['password'],PASSWORD_DEFAULT) ;
				mysqli_query($link,"INSERT INTO users SET login='".$login."', password='".$password."',email='".$email."',date_of_birth='".$date_of_birth."'");

				header("Location: ?action=successful_registration");
	} 
		
  	} 
 ?>

 
	<link href="./css/login.css" rel="stylesheet" type='text/css' />


	<div align="center" class="caption">Реєстрація</div>
	<div class="border">
	<form method="post"> 
		<div> 
			<label for="login"> Логін:</label><br>
			<input type="text" maxlength="20" name="login" id="login" />  
			<p style = "color:#CD5555; font-size: 16px;">
			<?php 
				if(isset($errors['login'])) echo $errors['login'];
			?>
		</div> 
		<div> 
			<label for="password"> Пароль:</label><br> 
			<input type="password" maxlength="10" name="password" id="password" /> 
			<p style = "color:#CD5555; font-size: 16px;">
			<?php 
				if(isset($errors['password'])) echo $errors['password'];
			?>
		</div>
		<div> 
			<label for="repeated_password"> Повторіть пароль:</label><br> 
			<input type="Password" maxlength="10" name="repeated_password" id="repeated_password" /> 
			<p style = "color:#CD5555; font-size: 16px;">
			<?php 
				if(isset($errors['repeated_password'])) echo $errors['repeated_password'];
			?>
		</div>
		<div>
			<label for="email">E-mail:</label><br>
			<input type="email" name="email" id="email" placeholder="example@ukr.net" id="email" />
			<p style = "color:#CD5555; font-size: 16px;">
			<?php 
				if(isset($errors['email'])) echo $errors['email'];
			?>
		</div>
		<div>
			<label for="date_of_birth"> Дата народження </label><br>
			<input type="text" name="date_of_birth" id="date_of_birth" />
			<p style = "color:#CD5555; font-size: 16px;">
			<?php 
				if(isset($errors['date_of_birth'])) echo $errors['date_of_birth'];
			?>
		</div>
		<div> 
			<input type="submit" value="Надіслати" name="submit" id="button" /> 

		</div> 
	</form>
	</div>
</div>

