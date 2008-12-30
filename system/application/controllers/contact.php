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

  function list_phone_details($kontak_id=null)
  {
    if (isset($kontak_id)) {
      $q_result = $this->Model_kontak_telepon->list_all($kontak_id); 
      $data['objects'] = $q_result->result_array();
      $this->load->view('jsonizer', $data);
    }
  }

  function list_email_details()
  {
    if (isset($kontak_id)) {
      $q_result = $this->Model_kontak_email->list_all($kontak_id); 
      $data['objects'] = $q_result->result_array();
      $this->load->view('jsonizer', $data);
    }
  }

}
?>

