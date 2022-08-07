<?php
require "db.php"; // подключение к БД

$data = $_POST; // присваиваем data все значения полученный post
$showError = False;
$_SESSION['authorized'] = False;

if(isset($data['signin'])){
	$errors = array();
	$showError = True;
	
	if(trim($data['email']) == ""){
		$errors[] = "Введите email!";
	}
	if(trim($data['pass']) == ""){
		$errors[] = "Введите пароль!";
	}
	
	$user = R::findOne('users', 'email = ?', array($data['email'])); // ищем пользователя в таблице с указанным email
	if($user){
		if(password_verify($data['pass'], $user->pass)){ // проверка пароля
			$_SESSION['user'] = $user;
			$_SESSION['authorized'] = True;
		} else{
			$errors[] = 'Неверный пароль';
		}
	} else{
		$errors[] = 'Пользователь не найден';
	}
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sig in</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body bgcolor="#B0C4DE" background="/auth_register/background.jpg">
	<div class="container mt-4" align="center">
		<h1 id="auth-h1" style="color: red; ">АВТОРИЗАЦИЯ</h1><br>
	 	<p style="color: red;"> <?php if($showError) {echo showError($errors); } ?></p>
	 	<form action="signin.php" method="post">
	  		<input type="email" class="form-control" name="email" id="email" placeholder="Введите email" required><br>
	  		<input type="password" class="form-control" name="pass" id="pass" placeholder="Введите пароль" required><br>
	  		<div class="row">
	  			<div class="col" align="left">
	  				<button class="btn btn-success" type="submit" name="signin">Авторизоваться</button>
	  			</div>
	  			<?php if($_SESSION['authorized']) header("Location: /auth_register/index.php"); ?>
	  			<div id="auth" class="col" align="center">
	  	  			<p> Вернуться на главную страницу? <a href="/auth_register/index.php">Да</a></p>
	  			</div>
	  		</div>
	  	</form>
	  </div>
</body>