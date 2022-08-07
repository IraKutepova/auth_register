<?php
require "db.php";

unset($_SESSION['user']);

header("Location: /auth_register/index.php");

?>