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
    $username = $_POST['username']; 
    $password = $_POST['password'];
    $data = $this->Model_pengguna->get_pengguna($username)->result_array();
    if (count($data) > 0) {
      $hash_ctx = hash_init('sha256');
      hash_update($hash_ctx, $password.$data[0]['salt']);
      $passwd_hash = hash_final($hash_ctx); 
      if ($passwd_hash === $data[0]['password']) {
        $_SESSION['pengguna_id'] = $data[0]['id'];
        $_SESSION['username'] = $username;
        echo "{result: 'ok'}";
        return;
      }
    }
    echo "{result: 'failed'}";
  }

  function logout()
  {
    session_start();
    session_destroy();
    session_start();
    session_regenerate_id();
  }

  function create()
  {
    $random_salt_length = 8;
    $salt = '';
    for ($i=0; $i<$random_salt_length; $i++) {
      $salt .= mt_rand(0,9);
    }
    $salt .= date('r');
    $hash_ctx = hash_init('sha256');
    hash_update($hash_ctx, $_POST['password'].$salt);
    $data['real_name'] = $_POST['username'];
    $data['user_name'] = $_POST['username'];
    $data['password'] = hash_final($hash_ctx);
    $data['salt'] = $salt;
    $this->Model_pengguna->insert($data);
    echo "{result: 'ok'}";
    /*$username = $_POST['username'];
    $password = $_POST['password'];*/
  }
}
?>

