<?php
class Contact extends Controller {

  function index()
  {
    echo 'Hello World!';
    phpinfo();
  }

  function create()
  {
    $data['name'] = $_POST['name'];
    $this->Model_kontak->insert($data);
    echo "{result: 'ok'}";
  }

  function list_data()
  {
    $q_result = $this->Model_kontak->list_all(); 
    $data['objects'] = $q_result->result_array();
    $this->load->view('jsonizer', $data);
  }

}
?>

