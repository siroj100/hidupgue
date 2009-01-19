<?php

function print_array($data) {
  echo '[';
  foreach($data as $row) {
    echo '{';
    foreach(array_keys($row) as $key) {
      if (isset($row[$key])) {
        echo $key.': ';
        if (is_array($row[$key]) === FALSE) {
          echo '"'.str_replace("\n","\\n",$row[$key]).'", ';
        } else {
          print_array($row[$key]);
          echo ',';
        }
      }
    }
    echo '},';
  }
  echo ']';
}

print_array($objects);

/*echo '[';
foreach($objects as $row) {
  echo '{';
  foreach(array_keys($row) as $key) {
    if (isset($row[$key])) {
      echo $key.': ';
      if (is_array($row[$key]) === FALSE) {
        echo '"'.str_replace("\n","\\n",$row[$key]).'", ';
      } else {
        print_array($row[$key]);
        echo ',';
      }
    }
  }
  echo '},';
}
echo ']';*/
?>
