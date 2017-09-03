<?php
  include_once('conn.php');
  include_once('json.php');

  $sql="SELECT MAX(Time) FROM Classtime";

  $result = mysqli_query($conn, $sql);
  if(!$result) {
    print_sql_error($conn, $sql);
    die();
  }

  $row = mysqli_fetch_array($result,MYSQLI_NUM);
  $highest_time = $row[0];

  $sql="DELETE FROM Classtime WHERE Time='$highest_time'";

  $result = mysqli_query($conn, $sql);
  if(!$result) {
    print_sql_error($conn, $sql);
    die();
  }

  print_sql_success();

  mysqli_close($conn);
?>
