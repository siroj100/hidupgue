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
      $data['new_contact'] = $this->load->view('new_contact','',true);
      $data['list_contact'] = $this->load->view('list_contact','',true);
      $this->load->view('frontend',$data);
    } else {
      $this->login();
    }
  }

  function activity($section=null, $param0=null)
  {
    if (isset($section)) {
      if ($section == 'new' && isset($param0)) {
        $this->load->view('new_activity_'.$param0);
      }
    }
  }

  function contact($section=null, $contact_id=null, $param=null)
  {
    if (isset($section)) {
      if ($section == 'details' && isset($contact_id)) {
        $data['contact_id'] = $contact_id;
        $this->load->view('list_contact_details',$data);
      }
    }
  }


}
?>

