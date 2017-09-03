<?php
  $lectureID = $_POST["lectureID"];
  
  include_once('conn.php');
  include_once('json.php');

  $sql="DELETE FROM Lecture WHERE ID=$lectureID";

  $result = mysqli_query($conn, $sql);
  if(!$result) {
    print_sql_error($conn, $sql);
    die();
  }

  $sql="DELETE FROM Status WHERE (ReservID=$lectureID) AND (Type=0)";
  
  $result = mysqli_query($conn, $sql);
  if(!$result) {
    print_sql_error($conn, $sql);
    die();
  }

  print_sql_success();

  mysqli_close($conn);
?>
