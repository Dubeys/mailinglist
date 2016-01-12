<?php

$email = $_GET['email'];

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
  <div class="row">
    <div class="column small-12 large-7 small-centered">
      <h1>Thank you</h1>
      <h3>But</h3>
      <h2>There is <span>one</span> last step</h2>
      <p>please verify your email (<?php echo $email; ?>) to validate your subscribtion.</p>
    </div>
  </div>

</body>
</html>
