<?php

$dsn = "mysql:host=localhost;dbname=pba";
$user = "root";
$passwd = "";

$pdo = new PDO($dsn, $user, $passwd);

try {
    $pdo = new PDO($dsn, $user, $passwd);
    // set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }