<?php
class Js extends Controller {

  function index()
  {
    phpinfo();
  }

  function user()
  {
    $this->load->view('user.js');
  }

  function activity()
  {
    $this->load->view('activity.js');
  }

  function note()
  {
    $this->load->view('note.js');
  }

  function contact()
  {
    $this->load->view('contact.js');
  }

}
?>

