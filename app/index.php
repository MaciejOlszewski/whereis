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


include_once("head.php");
?>


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
      </div>
    <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
      <a class="btn btn-lg btn-primary btn-block btn-logout" href="logout.php">Logout</a>
    </div>
  </div>
    <div class="row">
      <div class="col-xs-12" id="map">




      </div>

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

<?php

include_once("scripts.php");

?>
  </body>


</html>
