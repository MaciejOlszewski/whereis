<?php
session_start();
$_SESSION['login'] = false;
require_once 'db_conn.php';

if (!empty($_POST['login']) && !empty($_POST['password'])){
  $login = test_input($_POST['login']);
  $password = test_input($_POST['password']);
  $md5pass = md5($password);

  $query = "SELECT * FROM `users` WHERE `users` = '".$login."' AND `password` = '".$md5pass."'";

  $result = mysqli_query($connection, $query);

  if (mysqli_num_rows($result) > 0) {
    $_SESSION['login'] = true;
    header('Location: index.php');

  }
  else {
    echo '<span class="label label-warning warning">Wrong login or password</span>';
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
 ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Sign in</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" media="screen" title="no title">

  </head>
  <body>
<div class="container">
<div class="row">
  <div class="col-xs-12">


    <form class="form-signin" action="login.php" method="post">
      <h2>Sign in</h2>
      <input type="text" name="login" value="" placeholder="Login"><br>
      <input type="password" name="password" value="" placeholder="Password"><br>
      <input class="btn btn-lg btn-primary btn-block" type="submit" name="" value="Submit">

      <?php



        mysqli_close($connection);

       ?>

    </form>



     </div>

     </div>
   </div>
  </body>

</html>
