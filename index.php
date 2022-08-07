<?php
require 'db.php';

if(isset($_SESSION['user'])){
 $user = R::findOne('users', 'id= ?', array($_SESSION['user']->id));
}
?>

<!-- Главная страница с приветствием и сслыками на регистрацию и авторизацию. -->
<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Главная страница</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
</head>
<body bgcolor="#B0C4DE" background="/auth_register/background.jpg">
	<center>
	<div class="container mt-4" align="center">
	 	<?php
		if(isset($user)):
	  	?>
	  	<p style="font-size: 30px; padding-top: 10px;"> Привет, <?php echo $user->name;?>!</p><br>
	  	<p style="color: #228B22; font-size: 20px; padding-top: 10px;"> Авторизация прошла успешно!</p><br>
	  	<p> Чтобы выйти, нажмите <a href="logout.php"><i>здесь</i></a>!</p>
		<?php else: ?>
	  	<div id="form-id" align="center">
	  		<center>
	  		<h1 style="color: #FF6347; font-size: 70px; padding-top: 200px;">Добро пожаловать!</h1><br>
	  		<p style="color: #8B0000; font-size: 20px; padding-top: 10px;">Для регистрации нажмите <a href="/auth_register/signup.php" style="color: #8B0000;font-size: 20px;"><i>здесь</i></a></p>
	 		<p style="color: #8B0000; font-size: 20px; padding-top: 10px;"> Уже зарегистрированы? <a href="/auth_register/signin.php" style="color: #8B0000;font-size: 20px;"><i>Войти</i></a></p>
	  		</center>
	  	</div>
	  	<?php endif;?>
	</div>
</body>