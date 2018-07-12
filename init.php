<?php
     include 'connect.php';
     include 'User.php';
 
     global $pdo;
     session_start();
     $getFromU = new User($pdo);
?>