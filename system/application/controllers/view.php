<?php
class View extends Controller {

  function index()
  {
    echo 'Hello World!';
    phpinfo();
  }

  function login()
  {
    $this->load->view('login');
  }

  function frontend()
  {
    session_start();
    if (isset($_SESSION['username'])) {
      $data['new_activity'] = $this->load->view('new_activity','',true);
      $data['list_activity'] = $this->load->view('list_activity','',true);
      $data['new_note'] = $this->load->view('new_note','',true);
      $data['list_note'] = $this->load->view('list_note','',true);
      $this->load->view('frontend',$data);
    } else {
      $this->login();
    }
  }

}
?>

