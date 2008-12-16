<?php
class Note extends Controller {

  function index()
  {
    echo 'Hello World!';
  }

  function create()
  {
    $data['title'] = $_POST['title'];
    $data['teks'] = $_POST['teks'];
    $this->Model_catatan->insert($data);
    echo "{result: 'ok'}";
  }

  function list_data()
  {
    $q_result = $this->Model_catatan->list_all(); 
    $data['objects'] = $q_result->result_array();
    $this->load->view('jsonizer', $data);
  }
}
?>
