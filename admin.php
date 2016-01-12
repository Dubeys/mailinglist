<?php
include_once 'include/init.php';

if(!password_verify('954030RE322052', $_SESSION['uniq_id'])){die;}


if(!empty($_GET)){
  $user_id = trim(strip_tags($_GET['id']));
  $user_action = trim(strip_tags($_GET['action']));



  switch ($user_action){

    case 'modify':
    if(!empty($_POST)){

      $email = trim(strip_tags($_POST['email']));

      $sql = 'UPDATE users SET email = :email WHERE id = :id';
      $preparedStatement = $pdo->prepare($sql);
      $preparedStatement->bindValue('id',$user_id);
      $preparedStatement->bindValue('email',$email);
      $preparedStatement->execute();
      header('Location: admin.php');
    }

    break;

    case 'delete':
      $sql = 'DELETE FROM users WHERE id = :id';
      $preparedStatement = $pdo->prepare($sql);
      $preparedStatement->bindValue('id',$user_id);
      $preparedStatement->execute();
      header('Location: admin.php');
    break;

  }
}

$sql = 'SELECT * FROM users WHERE valid = true';
$preparedStatement = $pdo->prepare($sql);
$preparedStatement->bindValue('email', $email);
$preparedStatement->execute();
$fetch = $preparedStatement->fetchAll();

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

  <h1 class="absolute">Admin hub</h1>

  <div class="row">
    <ul class="column medium-6 medium-centered text-left">
      <?php
      foreach ($fetch as $row) {
        echo '<li>';
        echo " ".$row['email']." ";
        echo'</li>';
        echo '<a class="yellow" href="admin.php?id='.$row['id']. '&action=modify">edit |</a>';
        echo ' <a class="red" href="admin.php?id='.$row['id']. '&action=delete">delete</a>';

        if($user_action === 'modify' && $row['id'] === $user_id && empty($_POST)){
      ?>

        <form class="input-group far" action="admin.php?id=<?php echo $user_id; ?>&action=modify" method="post">
        <label>
          <input class="input-group-field" type="email" name="email" placeholder="new email..."></input>
        </label>

        <label class="input-group-button">
        <input type="submit" class="button" value="EDIT">
        </label>

      <?php
        }

      }
      ?>
    </ul>
  </div>

</body>
</html>
