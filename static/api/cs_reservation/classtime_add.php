<?php
  $classtime = $_POST["classtime"];

  include_once('conn.php');
  include_once('json.php');

  $sql="SELECT MAX(Time) FROM Classtime";

  $result = mysqli_query($conn, $sql);
  if(!$result) {
    print_sql_error($conn, $sql);
    die();
  }

  $row = mysqli_fetch_array($result,MYSQLI_NUM);
  $highest_time = $row[0] + 1;

  $sql="INSERT INTO Classtime (Time, Detail) VALUES ('$highest_time', '$classtime')";

  $result = mysqli_query($conn, $sql);
  if(!$result) {
    print_sql_error($conn, $sql);
    die();
  }

  print_sql_success();

  mysqli_close($conn);
?>
