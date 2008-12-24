<?php
echo '[';
foreach($objects as $row) {
  echo '{';
  foreach(array_keys($row) as $key) {
    if (isset($row[$key])) {
      echo $key.': '.'"'.str_replace("\n","\\n",$row[$key]).'", ';
    }
  }
  echo '},';
}
echo ']';
?>
