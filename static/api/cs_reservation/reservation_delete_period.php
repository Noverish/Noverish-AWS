<?php
  $startDate = $_POST["startDate"];
  $endDate = $_POST["endDate"];
  $deleteLecture = $_POST["deleteLecture"];

  include_once('conn.php');
  include_once('json.php');

  $sql="SELECT * FROM Status
  WHERE (date(Date) >= date('$startDate')) AND
	(date(Date) <= date('$endDate'))";

  $result1 = mysqli_query($conn, $sql);
  if(!$result1) {
    print_sql_error($conn, $sql);
    die();
  }

  while($row = mysqli_fetch_assoc($result1)) {
    $type = $row["Type"];
    $reservID = $row["ReservID"];

    if($type == 0) {
      if($deleteLecture != 0) {
        $sql="DELETE FROM Lecture WHERE ID=$reservID";

        $result = mysqli_query($conn, $sql);
        if(!$result) {
          print_sql_error($conn, $sql);
          die();
        }
        $sql="DELETE FROM Status WHERE ReservID=$reservID";

        $result = mysqli_query($conn, $sql);
        if(!$result) {
          print_sql_error($conn, $sql);
          die();
        }
      }
    } else if($type == 1) {
      $sql="DELETE FROM Reservation WHERE ID=$reservID";

      $result = mysqli_query($conn, $sql);
      if(!$result) {
        print_sql_error($conn, $sql);
        die();
      }

      $sql="DELETE FROM Status WHERE ReservID=$reservID";

      $result = mysqli_query($conn, $sql);
      if(!$result) {
        print_sql_error($conn, $sql);
        die();
      }
    }
  }

  print_sql_success();

  mysqli_close($conn);
?>
