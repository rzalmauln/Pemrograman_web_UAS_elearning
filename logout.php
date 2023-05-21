<?php

session_start();
$_SESSION['username'] = "";
$_SESSION['password'] = "";
$_SESSION['status'] = "";
session_destroy();

setcookie("username", "", time() - 60, "/");
setcookie("password", "", time() - 60, "/");

header("Location: ./login.php");
