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
    $_POST['primaryFlag'] = TRUE;
    if (!isset($_POST['phoneNumber']) || strlen(trim($_POST['phoneNumber'])) <= 0) {
      $_POST['phoneNumber'] = NULL;
    }
    $this->create_phone(TRUE);
    if (!isset($_POST['emailAddress']) || strlen(trim($_POST['emailAddress'])) <= 0) {
      $_POST['emailAddress'] = NULL;
    }
    $this->create_email(TRUE);
    echo "{result: 'ok'}";
  }

  function create_phone($as_child=FALSE)
  {
    if ($this->my_helper->_validate_session() !== TRUE) {
      echo "{result: 'failed'}";
      return;
    }
    $data['kontak_id'] = $_POST['contactId'];
    $data['phone_number'] = $_POST['phoneNumber'];
    $data['primary_flag'] = $_POST['primaryFlag'];
    $this->Model_kontak_telepon->insert($data);
    if ($as_child === FALSE) echo "{result: 'ok'}";
  }

  function edit_phone()
  {
    $kontak_id = $_POST['contactId'];
    if ($_POST['primaryFlag'] == TRUE) {
      $data['primary_flag'] = FALSE;
      $this->Model_kontak_telepon->update_all($kontak_id, $data);
    }
    $id = $_POST['id'];
    $data['phone_number'] = $_POST['phoneNumber'];
    $data['primary_flag'] = $_POST['primaryFlag'];
    $this->Model_kontak_telepon->update($kontak_id,$id,$data);
    echo "{result: 'ok'}";
  }

  function create_email($as_child=FALSE)
  {
    if ($this->my_helper->_validate_session() !== TRUE) {
      echo "{result: 'failed'}";
      return;
    }
    $kontak_id = $_POST['contactId'];
    $email_address = $_POST['emailAddress']; 
    $pengguna_id = $_SESSION['pengguna_id'];
    if (!isset($email_address) || strlen($email_address) <= 0) {
      echo "{result: 'failed'}";
      return;
    }
    $email_count = $this->Model_kontak_email->email_count($kontak_id, $pengguna_id);
    if ($email_count == 0) {
      $q_result = $this->Model_kontak_email->get_primary_email($kontak_id, $pengguna_id);
      $primary_email = $q_result->result_array();
      if (count($primary_email) > 0) {
        $data['primary_flag'] = TRUE;
        $data['email_address'] = $email_address;
        $kontak_email_id = $primary_email[0]['id'];
        $this->Model_kontak_email->update($kontak_id, $kontak_email_id, $data);
      } else {
        if ($as_child === FALSE) {
          echo "{result: 'failed'}";
          return;
        } else if ($as_child === TRUE) {
          $data['primary_flag'] = $_POST['primaryFlag'];
          $data['kontak_id'] = $kontak_id;
          $data['email_address'] = $email_address;
          $this->Model_kontak_email->insert($data);
        }
      }
    } else {
      if ($_POST['primaryFlag'] == TRUE) {
        $data['primary_flag'] = FALSE;
        $this->Model_kontak_email->update_all($kontak_id, $data);
      }
      $data['primary_flag'] = $_POST['primaryFlag'];
      $data['kontak_id'] = $kontak_id;
      $data['email_address'] = $email_address;
      $this->Model_kontak_email->insert($data);
    }
    if ($as_child === FALSE) echo "{result: 'ok'}";
  }

  function edit_email()
  {
    $kontak_id = $_POST['contactId'];
    if (isset($_POST['primaryFlag'])) {
      if ($_POST['primaryFlag'] == TRUE) {
        $data['primary_flag'] = FALSE;
        $this->Model_kontak_email->update_all($kontak_id, $data);
      }
      $data['primary_flag'] = $_POST['primaryFlag'];
    }
    $id = $_POST['id'];
    $data['email_address'] = $_POST['emailAddress'];
    $this->Model_kontak_email->update($kontak_id,$id,$data);
    echo "{result: 'ok'}";
  }

  function list_data()
  {
    if ($this->my_helper->_validate_session() !== TRUE) {
      echo "{result: 'failed'}";
      return;
    }
    $q_result = $this->Model_kontak->list_all_w_primary_details($_SESSION['pengguna_id']); 
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

  function details($kontak_id=null)
  {
    if ($this->my_helper->_validate_session() !== TRUE) {
      echo "{result: 'failed'}";
      return;
    }
    if (isset($kontak_id)) {
      $pengguna_id = $_SESSION['pengguna_id'];
      $q_result = $this->Model_kontak->get_kontak($kontak_id, $pengguna_id); 
      $objects = $q_result->result_array();
      if (count($objects) > 0) {
        $data['objects'] = $objects;
        $q_result = $this->Model_kontak_email->list_all($kontak_id);
        $data['objects'][0]['email'] = $q_result->result_array();
        $q_result = $this->Model_kontak_telepon->list_all($kontak_id);
        $data['objects'][0]['phone_number'] = $q_result->result_array();
        $this->load->view('jsonizer', $data);
        return;
      } else {
        echo "{result: 'failed'}";
        return;
      }
    }
  }

  function find_by_name($kontak_name)
  {
    if ($this->my_helper->_validate_session() !== TRUE) {
      echo "{result: 'failed'}";
      return;
    }
    if (isset($kontak_name)) {
      $q_result = $this->Model_kontak->find_contact_by_name($kontak_name,$_SESSION['pengguna_id']); 
      $data['objects'] = $q_result->result_array();
      $this->load->view('jsonizer', $data);
    }
  }

}
?>

