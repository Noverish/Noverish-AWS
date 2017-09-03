<?php
  $keyword = $_POST["keyword"];

  include_once('conn.php');

  $sql="SELECT * FROM Jungo";
  $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

  $data = array();
  while($row = mysqli_fetch_assoc($result)) {
      $data[] = $row;
  }

  //from http://stackoverflow.com/a/16498714
  function raw_json_encode($input, $flags = 0) {
      $fails = implode('|', array_filter(array(
          '\\\\',
          $flags & JSON_HEX_TAG ? 'u003[CE]' : '',
          $flags & JSON_HEX_AMP ? 'u0026' : '',
          $flags & JSON_HEX_APOS ? 'u0027' : '',
          $flags & JSON_HEX_QUOT ? 'u0022' : '',
      )));
      $pattern = "/\\\\(?:(?:$fails)(*SKIP)(*FAIL)|u([0-9a-fA-F]{4}))/";
      $callback = function ($m) {
          return html_entity_decode("&#x$m[1];", ENT_QUOTES, 'UTF-8');
      };
      return preg_replace_callback($pattern, $callback, json_encode($input, $flags));
  }
  
  header('Content-type:application/json;charset=utf-8');
  echo raw_json_encode($data);
?>
