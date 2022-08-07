<?php
require "db.php"; // подключение к БД

$data = $_POST; // присваиваем data все значения полученные post
$showError = False;
$_SESSION['registered'] = False;

if(isset($data['signup'])){
	$errors = array();
	$showError = True;
	if(trim($data['name']) == ""){
		$errors[] = "Введите имя!";
	}
	if(trim($data['email']) == ""){
		$errors[] = "Введите email!";
	}
	if(trim($data['pass']) == ""){
		$errors[] = "Введите пароль!";
	}
	if(trim($data['pass']) != trim($data['pass_2'])){
		$errors[] = "Пароли не совпадают!";
	}
	if(R::count('users', 'email= ?', array($data['email'])) > 0){
		$errors[] = "Пользователь с почтой {$data['email']} уже зарегистрирован!";
	}
	if(empty($errors)){
		$user = R::dispense('users'); 

		$user->name = $data['name'];
		$user->email = $data['email'];
		$user->pass = password_hash($data['pass'], PASSWORD_DEFAULT); // hash
		R::store($user); // запись в БД
		$_SESSION['registered'] = True;
	}
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Sign up</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"> 
	<link rel="stylesheet" href="css/style.css">
</head>
<body bgcolor="#B0C4DE" background="/auth_register/background.jpg">	
	<div class="container mt-4" align="center">
		<div id="form-id">
	  		<h1 class="text-warning">РЕГИСТРАЦИЯ</h1><br>
	  		<p style="color: red;"> <?php if($showError) {echo showError($errors); } ?></p>
	 		<form action="signup.php" method="post">
	  			<input type="text" class="form-control" name="name" id="name" placeholder="Введите имя"><br>
	  			<input type="email" class="form-control" name="email" id="email" placeholder="Введите email"><br>
	  			<input type="password" class="form-control" name="pass" id="pass" placeholder="Введите пароль" ><br>	
	  			<input type="password" class="form-control" name="pass_2" id="pass_2" placeholder="Повторите ввод пароля" ><br>
	  			<div class="row">
	  				<div class="col">
	  					<button class="btn btn-success" type="submit" name="signup">Зарегистрировать</button>
	  	  			</div>
	  	  			<?php
	  	  			if($_SESSION['registered']):
	  	  			?>
	  	  				<p> Вы успешно зарегистрировались, авторизуйтесь</p>
	  	  			<?php endif;?>
	  	  			<div id="auth" class="col" align="center">
	  	  				<p> Уже зарегистрированы? <a href="/auth_register/signin.php">Войти</a></p> 
	  				</div>
	  			</div>
	  		</form>
	  	</div>
  	</div>
</body>