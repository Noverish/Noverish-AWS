<?php
function print_sql_result($result) {
  $data = array();
  while($row = $result->fetch_array(MYSQL_ASSOC)) {
    $data[] = $row;
  }

  echo("{\"res\":\"1\", \"msg\":\"\", \"query\":\"\", \"data\":");
  echo(json_encode($data));
  echo("}");
}

function print_sql_error($conn, $sql) {
  $error = mysqli_error($conn);
  echo("{\"res\":\"0\", \"msg\":\"$error\", \"query\":\"$sql\", \"data\":[]}");
}

function print_sql_success() {
  echo("{\"res\":\"1\", \"msg\":\"\", \"query\":\"\", \"data\":[]}");
}

function print_exception($res,$msg,$query) {
  echo("{\"res\":\"$res\", \"msg\":\"$msg\", \"query\":\"$query\", \"data\":[]}");
}
?>
