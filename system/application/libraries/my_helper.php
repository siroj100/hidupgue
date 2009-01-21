<?php
class My_helper {
  function _validate_session()
  {
    if (!isset($_SESSION)) {
      session_start();
    }
    if (!isset($_SESSION['username']) || !isset($_SESSION['pengguna_id'])) {
      return FALSE;
    } else {
      return TRUE;
    }
  }
}
?>

