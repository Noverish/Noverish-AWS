<?php
  $title = $_POST["title"];
  $price = $_POST["price"];
  $date = $_POST["date"];
  $url = $_POST["url"];
  $keyword = $_POST["keyword"];

  include_once('conn.php');

  $sql="INSERT INTO Jungo (title, price, date, url, keyword) VALUES ('$title', $price, '$date', '$url', '$keyword')";
  $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

  $res["res"] = 1;
  $res["msg"] = "success";

  echo json_encode($res);
?>
