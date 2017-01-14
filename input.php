<?php
include_once 'db_conn.php';

if (!empty($_POST["acc"])
&& !empty($_POST["time"])
&& !empty($_POST["battery"])
&& !empty($_POST["lat"])
&& !empty($_POST["lon"]))
{

  $acc       = mysqli_real_escape_string($connection, $_POST['acc']);
  $time      = mysqli_real_escape_string($connection, $_POST['time']);
  $battery   = mysqli_real_escape_string($connection, $_POST['battery']);
  $lat       = mysqli_real_escape_string($connection, $_POST['lat']);
  $lon       = mysqli_real_escape_string($connection, $_POST['lon']);



  $sql = "UPDATE `location_data` SET `acc` = '$acc', `battery` = '$battery', `time` = '$time', `lat` = '$lat', `lon` = '$lon' WHERE `location_data`.`id` = 1";

  if (mysqli_query($connection, $sql)) {
      echo "Record updated successfully";
  } else {
      echo "Error updating record: ";
  }

}

mysqli_close($connection)
?>
