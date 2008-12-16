<?php
class User extends Controller {

  function index()
  {
    echo 'Hello World!';
    phpinfo();
  }

  function login()
  {
    session_start();
    $username = $_POST['username']; $_SESSION['username'] = $username;
    $password = $_POST['password']; $_SESSION['password'] = $password;
    echo "{result: 'ok'}";
  }
}
?>

