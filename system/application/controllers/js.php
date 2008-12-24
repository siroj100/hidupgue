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

  function activity($section)
  {
    $data['section'] = $section;
    $this->load->view('activity.js',$data);
  }

  function note($section)
  {
    $data['section'] = $section;
    $this->load->view('note.js',$data);
  }

  function contact($section)
  {
    $data['section'] = $section;
    $this->load->view('contact.js',$data);
  }

}
?>

