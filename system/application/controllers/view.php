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
      $data['user_agent'] = $this->input->user_agent();
      $data['activity'] = $this->load->view('activity','',true);
      $data['note'] = $this->load->view('note','',true);
      $data['contact'] = $this->load->view('contact','',true);
      $this->load->view('frontend',$data);
    } else {
      $this->login();
    }
  }

  function frontend2()
  {
    session_start();
    if (isset($_SESSION['username'])) {
      $data['user_agent'] = $this->input->user_agent();
      $data['contact'] = $this->load->view('contact','',true);
      $this->load->view('frontend2',$data);
    } else {
      $this->login();
    }
  }

  function create_user()
  {
      $this->load->view('user_create');
  }

  function activity($section=null, $param0=null)
  {
    if (isset($section)) {
      if ($section == 'new' && isset($param0)) {
        $this->load->view('new_activity_'.$param0);
      }
    }
  }

}
?>

