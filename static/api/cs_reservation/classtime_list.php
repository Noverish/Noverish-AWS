<?php
  include_once('conn.php');
  include_once('json.php');

  $sql="SELECT * FROM Classtime ORDER BY time ASC";

  $result = mysqli_query($conn, $sql);
  if(!$result) {
    echo("0");
    die();
  }

  print_sql_result($result);

  mysqli_close($conn); 
?>
