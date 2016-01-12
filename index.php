<?php
include_once('include/init.php');

$errors = [];

if(!empty($_POST)){

  //honey pot
    if($_POST['login'] != ''){
      die;
    }

  //clean input
    $email = trim(strip_tags($_POST['email']));

    $sql = 'SELECT email FROM users WHERE email = :email';
    $preparedStatement = $pdo->prepare($sql);
    $preparedStatement->bindValue('email', $email);
    $preparedStatement->execute();
    $fetch = $preparedStatement->fetch();

    if(!empty($fetch)){
      $errors['email'] = "you already subscribed to this mailinglist";
    }

    if($email == '' || !filter_var($email,FILTER_VALIDATE_EMAIL)){
      $errors['email'] = "enter a valid email";
    }

    if(count($errors) == 0){

      $sql = 'INSERT INTO users(email, secret) VALUES(:email, :secret)';

      $secret = uniqid();
      $preparedStatement = $pdo->prepare($sql);
      $preparedStatement->bindValue('email', $email);
      $preparedStatement->bindValue('secret', $secret);

      if($preparedStatement->execute()){
        $_SESSION['email'] = $email;
        redirectTo('check.php?email='.$email);
      }
    }
}
?>

<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="css/foundation.min.css" />
    <link rel="stylesheet" type="text/css" href="css/styles.css" />
    <title>Such invention</title>
  </head>
<body>
  <form class="row" action="index.php" method="post">
    <div class="column small-12 large-7 small-centered">

      <?php if(!empty($errors['email'])){echo $errors['email'];} ?>

      <label>
        <input type="email" name="email" value="" placeholder="email...">
      </label>

      <label class="hide">
        <input type="name" name="login" value="">
      </label>

      <input type="submit" name="" class="button" value="">
    </div>
  </form>

</body>
</html>
