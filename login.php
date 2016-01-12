<?php
include_once 'include/init.php';

$_SESSION = [];

$login = 'suchadmin';
$password = '12341234';
$secret = '954030RE322052';

if(!empty($_POST)){

  //honey pot
    if($_POST['age'] != ''){
      die;
    }

  //clean input
    $password_user = trim(strip_tags($_POST['password']));
    $login_user = trim(strip_tags($_POST['login']));

    if($password === $password_user && $login === $login_user){
      $_SESSION['uniq_id'] = password_hash($secret, PASSWORD_DEFAULT);
      redirectTo('admin.php');
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
  <div class="absolute ">
    <h1>Login</h1>
  </div>

  <div class="down">
    <div>
      <img src="assets/doge.png">
    </div>
  </div>

  <form class="row" action="login.php" method="post">

    <div class="column medium-4 medium-centered ">

      <label>
        <input type="text" name="login" value="" placeholder="login...">
      </label>

      <label>
        <input type="password" name="password" value="" placeholder="password...">
      </label>

      <label class="hide">
        <input type="name" name="age" value="">
      </label>

      <input type="submit" name="" class="button expanded" value="ENTER PANEL">
    </div>

    <?php if(!empty($errors['email'])){echo '<p style="">'.$errors['email'].'</p>';} ?>
  </form>

</body>
</html>
