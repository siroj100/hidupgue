<?php
class Contact extends Controller {

  function index()
  {
    echo 'Hello World!';
    phpinfo();
  }

  function create()
  {
    if ($this->my_helper->_validate_session() !== TRUE) {
      echo "{result: 'failed'}";
      return;
    }
    $data['name'] = $_POST['name'];
    $data['pengguna_id'] = $_SESSION['pengguna_id'];
    $this->Model_kontak->insert($data);
    $kontak_id = $this->Model_kontak->db->insert_id();
    $_POST['contactId'] = $kontak_id;
    if (isset($_POST['phoneNumber'])) {
      $this->create_phone(TRUE);
    }
    if (isset($_POST['emailAddress'])) {
      $this->create_email(TRUE);
    }
    echo "{result: 'ok'}";
  }

  function create_phone($as_child=FALSE)
  {
    $data['kontak_id'] = $_POST['contactId'];
    $data['phone_number'] = $_POST['phoneNumber'];
    $this->Model_kontak_telepon->insert($data);
    if ($as_child === FALSE) echo "{result: 'ok'}";
  }

  function edit_phone()
  {
    $kontak_id = $_POST['contactId'];
    $id = $_POST['id'];
    $data['phone_number'] = $_POST['phoneNumber'];
    $this->Model_kontak_telepon->update($kontak_id,$id,$data);
    echo "{result: 'ok'}";
  }

  function create_email($as_child=FALSE)
  {
    $data['kontak_id'] = $_POST['contactId'];
    $data['email_address'] = $_POST['emailAddress'];
    $this->Model_kontak_email->insert($data);
    if ($as_child === FALSE) echo "{result: 'ok'}";
  }

  function edit_email()
  {
    $kontak_id = $_POST['contactId'];
    $id = $_POST['id'];
    $data['email_address'] = $_POST['emailAddress'];
    $this->Model_kontak_email->update($kontak_id,$id,$data);
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

  function list_email_details($kontak_id=null)
  {
    if (isset($kontak_id)) {
      $q_result = $this->Model_kontak_email->list_all($kontak_id); 
      $data['objects'] = $q_result->result_array();
      $this->load->view('jsonizer', $data);
    }
  }

}
?>

