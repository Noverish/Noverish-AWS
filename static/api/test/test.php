<?php
    include_once("conn.php");

    $sql = "SELECT * FROM Classroom";
    $result = mysqli_query($conn, $sql);
    while($row = $result->fetch_array(MYSQL_ASSOC)) {
        echo($row["Classroom"]);
    }
?>
