<?php
  $conn = mysqli_connect("db.noverish.me","noverish","1q2w3e4r!!","dbnoverish");

  if(mysqli_connect_errno()) {
    echo("Failed to connect MySQL: ".mysqli_connect_error());
  }

  mysqli_query($conn, "SET CHARACTER SET utf8");
?>
