<?php
  $log = $_GET["log"];

  echo($log);

  include_once('conn.php');
  include_once('json.php');

  $timeStr = date("Y-m-d H:i:s");
  $sql="INSERT INTO ReservationLog (Log, DateTime) VALUES ('$log', '$timeStr')";

  $result = mysqli_query($conn, $sql);
  if(!$result) {
    print_sql_error($conn, $sql);
    die();
  }

  print_sql_success();

  mysqli_close($conn);
?>
