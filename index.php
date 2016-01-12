<?php
include_once('include/init.php');
require_once('include/phpmailer/PHPMailerAutoload.php');

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

      $sql = 'INSERT INTO users(email, secret,valid) VALUES(:email, :secret,:valid)';

      $secret = uniqid();
      $preparedStatement = $pdo->prepare($sql);
      $preparedStatement->bindValue('email', $email);
      $preparedStatement->bindValue('secret', $secret);
      $preparedStatement->bindValue('valid', false);



      if($preparedStatement->execute()){

        //-------------------------------------------------------------------@@@

      $mail = new PHPMailer;

      //$mail->SMTPDebug = 3;                               // Enable verbose debug output

      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'smtp.mandrillapp.com';  // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = 'alexandre@pixeline.be';                 // SMTP username
      $mail->Password = 'bDMUEuWn1H4r3FCGQjyO-g';                           // SMTP password
      $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 587;                                    // TCP port to connect to

      $mail->setFrom('derval.igor@gmail.com','Your Lord');
      $mail->addAddress($email);                            // Add a recipient

      $mail->isHTML(true);                                  // Set email format to HTML

      $mail->Subject = 'Such invention';
      $mail->Body    = '<a href="http://localhost:8888/mailinglist/validation.php?id='.$secret.'">Validate email</a>';

      if(!$mail->send()) {
          // echo 'Message could not be sent.';
          // echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
          // echo 'Message has been sent';
      }

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
  <form class="row collapse" action="index.php" method="post">

    <div class="column small-12 medium-7 large-9 ">

      <label>
        <input type="email" name="email" value="" placeholder="email...">
      </label>

      <label class="hide">
        <input type="name" name="login" value="">
      </label>

    </div>

    <div class="column small-12 medium-5 large-3 ">
      <input type="submit" name="" class="button expanded" value="SUBSCRIBE">
    </div>

    <?php if(!empty($errors['email'])){echo '<p style="">'.$errors['email'].'</p>';} ?>
  </form>

</body>
</html>
