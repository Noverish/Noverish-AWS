<?php
  include_once('conn.php');
  include_once('json.php');

  $sql="SELECT Classroom FROM Classroom ORDER BY Classroom ASC";

  $result = mysqli_query($conn, $sql);
  if(!$result) {
    print_sql_error($conn, $sql);
    die();
  }

  print_sql_result($result);

  mysqli_close($conn);
?>
