<?php
require_once 'include/init.php';

$id_secret = $_GET['id'];

$sql = 'SELECT * FROM users WHERE secret = :secret';
$preparedStatement = $pdo->prepare($sql);
$preparedStatement->bindValue('secret', $id_secret);
$preparedStatement->execute();
$fetch = $preparedStatement->fetch();

if(strtotime($fetch['date']) >= (time() - (30*60))){
  $sql = 'UPDATE users SET valid = true WHERE secret = :secret';
  $preparedStatement = $pdo->prepare($sql);
  $preparedStatement->bindValue('secret',$id_secret);
  $preparedStatement->execute();
  redirectTo('congrats.php?email='.$fetch['email']);
}else if(!$fetch['valid']){
  $sql = 'DELETE FROM users WHERE secret = :secret';
  $preparedStatement = $pdo->prepare($sql);
  $preparedStatement->bindValue('secret',$id_secret);
  $preparedStatement->execute();
}else {
  redirectTo('congrats.php?email='.$fetch['email']);
}

?>
