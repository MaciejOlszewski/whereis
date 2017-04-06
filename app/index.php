<?php

session_start();

if ($_SESSION['login']==true) {
}
else {
    header('Location: login.php');
}

 ?>
<!DOCTYPE html>
<html>
<html lang="en">

<?php
require_once 'db_conn.php';

$query = "SELECT * FROM `location_data` WHERE 1 LIMIT 1";
$result = mysqli_query($connection, $query);


if (mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {
        $acc = $row["acc"];
        $battery = $row["battery"];
        $time = $row["time"];
        $lat = $row["lat"];
        $lon = $row["lon"];
    }
}


?>
  <head>
    <meta charset="UTF-8">
    <title>Where is ?</title>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css" media="screen" title="no title"> -->






    <!--build:css css/styles.min.css-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" media="screen" title="no title">
    <!--endbuild-->

    <!--build:js js/main.min.js -->
    <!-- <script src="js/lib/filename.js"></script> -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="js/test.js"></script>
    <!-- endbuild -->








  </head>
  <body>

<div class="container">

  <div class="row">
    <div class="col-xs-12">

    <h1>Where is ?</h1>
    <p class="data">
      Last position posted time: <?php echo gmdate('r', $time);?><br>
      Location accurancy: <?php echo $acc ?> meters <br>
      Battery: <?php echo $battery ?>%
    </p>
    <div id="map">




    </div>
    <script>
      function initMap() {
        var mylocation = {lat: <?php echo $lat ?>, lng: <?php echo $lon ?>};
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 13,
          center: mylocation
        });
        var marker = new google.maps.Marker({
          position: mylocation,
          map: map,
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=<?php echo ($config['mapskey']) ?>&callback=initMap">
    </script>
  </div>
</div>
</div>
  </body>
  <?php


  mysqli_close($connection);


   ?>
</html>
