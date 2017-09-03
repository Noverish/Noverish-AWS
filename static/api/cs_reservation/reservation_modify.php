<?php
  $reservID = $_POST["reservID"];
  $password = $_POST["password"];
  $userName = $_POST["userName"];
  $contact = $_POST["contact"];
  $content = $_POST["content"];
  $isUserMode = $_POST["isUserMode"];

  include_once('conn.php');
  include_once('json.php');

  if($isUserMode != 0) {
    $sql = "SELECT * FROM Reservation 
      WHERE ID=$reservID AND Password='$password'";

    $result = mysqli_query($conn, $sql);
    if(!$result) {
      print_sql_error($conn, $sql);
      die();
    }

    if(mysqli_num_rows($result) == 0) {
      print_exception(2,"Wrong Password","");
      die();
    }
  }

  $sql="UPDATE Reservation SET UserName='$userName', Contact='$contact', Content='$content' WHERE ID=$reservID";

  $result = mysqli_query($conn, $sql);
  if(!$result) {
    print_sql_error($conn, $sql);
    die();
  }

  $sql="UPDATE Status SET UserName='$userName', Contact='$contact', Content='$content' WHERE ReservID=$reservID";

  $result = mysqli_query($conn, $sql);
  if(!$result) {
    print_sql_error($conn, $sql);
    die();
  }

  print_sql_success();

  mysqli_close($conn);
?>
