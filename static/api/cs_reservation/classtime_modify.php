<?php
  $time = $_POST["time"];
  $detail = $_POST["detail"];

  include_once('conn.php');
  include_once('json.php');

  $sql="UPDATE Classtime SET Detail='$detail' WHERE Time='$time'";

  $result = mysqli_query($conn, $sql);
  if(!$result) {
    print_sql_error($conn, $sql);
    die();
  }

  print_sql_success();

  mysqli_close($conn);
?>

