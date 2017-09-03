<?php
  $json["number"] = 1234;
  $json["string"] = "hello world";
  $json["bool1"] = true;
  $json["bool2"] = false;
  $json["null"] = null;

  $arr = array(
	array('entry1'=>1),
	array('entry2'=>2),
	array('entry3'=>3));

  $json["arr"] = $arr;

  $inner["inner1"] = "inner";
  $inner["inner2"] = "4321";

  $json["inner"] = $inner;
  
  echo json_encode($json);
?>
