<?php

$config = parse_ini_file('../credentials/credentials.ini');


$connection = mysqli_connect($config['host'], $config['user'], $config['pass'], $config['db']);
if (mysqli_connect_errno())
  {
  die("Failed to connect to MySQL");
  }

 ?>
