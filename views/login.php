<?php
if(isset($_POST['submit'])) {

    $login = $_POST['login'];
    $password = $_POST['password'];

    $link = mysqli_connect('localhost', 'root', '', 'the_musicend');
    if (mysqli_connect_errno()) {
        printf("Помилка: %s\n", mysqli_connect_error());
        exit();
    }

    mysqli_query($link, "SET NAMES 'utf8'");

    $result = mysqli_query($link, "SELECT password, id, admin FROM users WHERE login = '$login'");
    
    if ($result){
        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])){
           
            $_SESSION['id'] = $row['id'];
            $_SESSION['admin'] = $row['admin'];
            $_SESSION['login'] = $login;
          header("Location: ?action=main");
        }
        else {$error=  "Неправильний логін або пароль";
		}
    }
    else {$error= "Неправильний логін або пароль";
	}

    mysqli_close($link);
}

?>


<link href="./css/login.css" rel="stylesheet" type='text/css' /> 


<div align="center" class="caption">Вхід</div> 
<div class="border"> 
<form method="post"> 
<div>
	<p style = "color:#CD5555; font-size: 20px;">
		<?php 
			if(isset($error)) echo $error;
		?>
</div>
<div> 
	<label for="login"> Логін:</label><br> 
	<input type="text" maxlength="20" name="login" id="login" /> 
</div> 
<div> 
	<label for="password"> Пароль:</label><br> 
	<input type="password" maxlength="10" name="password" id="password" /> 
</div> <br>
<div> 
	<input type="submit" value="Увійти" name="submit" id="button" /> 
</div> <br>
</form> 
</div>