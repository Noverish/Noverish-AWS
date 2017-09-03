<?php
  $year = $_POST["year"];
  $semester = $_POST["semester"];
  $dayOfWeek = $_POST["dayOfWeek"];
  $classtime = $_POST["classtime"];
  $classroom = $_POST["classroom"];
  $professor = $_POST["professor"];
  $contact = $_POST["contact"];
  $code = $_POST["code"];
  $name = $_POST["name"];
  $startDate = $_POST["startDate"];
  $endDate = $_POST["endDate"];

  include_once('conn.php');
  include_once('json.php');

  $sql="INSERT INTO Lecture (
    Year, Semester, DayOfWeek, Classtime, Classroom,
    Professor, Contact, Code, Name) VALUES (
      '$year','$semester','$dayOfWeek','$classtime','$classroom',
      '$professor','$contact','$code','$name')";

  $result = mysqli_query($conn, $sql);
  if(!$result) {
    print_sql_error($conn, $sql);
    die();
  }

  $sql="SELECT ID FROM Lecture
	WHERE (Name = '$name') AND
	      (DayOfWeek = '$dayOfWeek') AND
	      (Classroom = '$classroom') AND
	      (Classtime = '$classtime')";

  $result = mysqli_query($conn, $sql);
  if(!$result) {
    print_sql_error($conn, $sql);
    die();
  }

  $input_days = explode(";", $dayOfWeek);
  $input_classtimes = explode(";", $classtime);
  $input_classrooms = explode(";", $classroom);

  if(!(count($input_days) == count($input_classtimes) && count($input_days) == count($input_classrooms))) {
    echo("{\"res\":\"0\", \"msg\":\"input error\", \"query\":\"$sql\"}");
    die();
  }

  $row = mysqli_fetch_array($result,MYSQLI_NUM);
  $day_num = count($input_days);
  $days = array();
  $days[0] = iconv("euckr","utf-8","일");
  $days[1] = iconv("euckr","utf-8","월");
  $days[2] = iconv("euckr","utf-8","화");
  $days[3] = iconv("euckr","utf-8","수");
  $days[4] = iconv("euckr","utf-8","목");
  $days[5] = iconv("euckr","utf-8","금");
  $days[6] = iconv("euckr","utf-8","토");
  $reservID = $row[0];
  $type = 0;
  $content = $code." - ".$name;

  for($i = 0; $i < $day_num; $i++) {
    $now_day = $input_days[$i];
    $class_tmp = explode("-", $input_classtimes[$i]);
    $startClass = $class_tmp[0];
    $endClass = $class_tmp[1];
    $now_classroom = $input_classrooms[$i];

    $now = new DateTime($startDate);
    $end = new DateTime($endDate);

    for(;$now->diff($end)->invert == 0;$now->add(new DateInterval('P1D'))) {
      $dw = date("w", $now->getTimestamp()) % 7;

      if(strcmp($now_day, $days[$dw]) == 0) {
        for($time = $startClass; $time <= $endClass; $time++) {
          $now_str = $now->format('Y-m-d');

          $sql="INSERT INTO Status (
            ReservID, Type, Date, Classtime, Classroom,
            UserName, Contact, Content) VALUES (
              '$reservID','$type','$now_str','$time','$now_classroom',
              '$professor','$contact','$content')";

          $result = mysqli_query($conn, $sql);
          if(!$result) {
            print_sql_error($conn, $sql);
            die();
          }
        }
      }
    }
  }

  print_sql_success();

  mysqli_close($conn);
?>
