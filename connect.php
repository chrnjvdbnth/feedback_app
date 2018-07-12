<?php
    $dsn  = 'mysql:host=localhost;dbname=highradius'; //edit this to change dbname
    $user = 'root'; //edit this to change user
    $pass = ''; //edit this to change password
    try{
        $pdo = new PDO($dsn,$user,$pass);
    }catch(PDOException $e){
        echo 'Connection error !' . $e->getMessage();
    }
?>