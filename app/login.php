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

<?php

include_once("head.php");

 ?>


  <body>
<div class="container">
<div class="row">
  <div class="col-xs-12">
    <h2 class="text-center">Sign in</h2>


    <form class="form-signin" action="login.php" method="post">
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
