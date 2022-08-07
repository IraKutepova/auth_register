<?php
// Подключаем библиотеку RedBeanPHP для работы с БД 
require "libs/rb.php";

$db = 'mysql:host=localhost;dbname=reg';
$mainuser = 'root';
$password = '';

// Подключаемся к БД
R::setup($db, $mainuser, $password);
// Проверка подключения к БД
if(!R::testConnection()) die('No DB connection!');
//else echo "connect";
// функция отображения ошибок
function showError($errors){
        return array_shift($errors);
}

session_start(); // Создаем сессию для работы с формами
?>