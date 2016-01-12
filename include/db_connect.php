<?php
  $db = 'mysql:dbname=mailinglist;host=127.0.0.1:8889';
  $user = 'root';
  $password = 'root';

  try {
    $pdo = new PDO($db,$user,$password);
  } catch (PDOException $e) {
    echo 'Connection failed: '.$e->getMessage();
  }
