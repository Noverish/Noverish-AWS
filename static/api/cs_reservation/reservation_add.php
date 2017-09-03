<?php
  $startDate = $_POST["startDate"];
  $endDate = $_POST["endDate"];
  $startClass = $_POST["startClass"];
  $endClass = $_POST["endClass"];
  $classroom = $_POST["classroom"];
  $userName = $_POST["userName"];
  $contact = $_POST["contact"];
  $content = $_POST["content"];
  $password = $_POST["password"];

  include_once('conn.php');
  include_once('json.php');

  $sql="INSERT INTO Reservation (
    StartDate, EndDate, StartClass, EndClass, Classroom,
    UserName, Contact, Content, Password) VALUES (
    '$startDate','$endDate','$startClass','$endClass','$classroom',
    '$userName','$contact','$content','$password')";

  $result = mysqli_query($conn, $sql);
  if(!$result) {
    print_sql_error($conn, $sql);
    die();
  }

  $sql="SELECT ID FROM Reservation
  WHERE (date(StartDate) = date('$startDate')) AND
        (date(EndDate) = date('$endDate')) AND
        (Classroom = '$classroom') AND
        (StartClass = $startClass) AND
        (EndClass = $endClass)";

  $result = mysqli_query($conn, $sql);
  if(!$result) {
    print_sql_error($conn, $sql);
    die();
  }

  $row = mysqli_fetch_array($result,MYSQLI_NUM);
  $reservID = $row[0];
  $now = new DateTime($startDate);
  $end = new DateTime($endDate);
  $type = 1;

  for(; $now->diff($end)->days <= 0; $now->add(new DateInterval('P1D'))) {
    for($time = $startClass; $time <= $endClass; $time++) {
      $now_str = $now->format('Y-m-d');

      $sql="INSERT INTO Status (
        ReservID, Type, Date, Classtime, Classroom,
        UserName, Contact, Content) VALUES (
          '$reservID','$type','$now_str','$time','$classroom',
          '$userName','$contact','$content')";

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
