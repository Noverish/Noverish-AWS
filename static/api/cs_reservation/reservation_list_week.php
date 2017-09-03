<?php
  $date = $_POST["date"];

  $endDate = new DateTime($date);
  $endDate->add(new DateInterval('P7D'));
  $endDateStr = $endDate->format('Y-m-d');

  include_once('conn.php');
  include_once('json.php');

  $sql="SELECT * FROM Status 
  WHERE(date(Date) >= date('$date')) AND
       (date(Date) <= date('$endDateStr'))";

  $result = mysqli_query($conn, $sql);
  if(!$result) {
    print_sql_error($conn, $sql);
    die();
  }

  print_sql_result($result);

  mysqli_close($conn);
?>
