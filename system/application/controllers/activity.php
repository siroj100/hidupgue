<?php
class Activity extends Controller {

  function index()
  {
    echo 'Hello World!';
  }

  function create()
  {
    $data['name'] = $_POST['name'];
    $data['description'] = $_POST['description'];
    $data['start_executed_date'] = $_POST['startExecutedDate'].' '.$_POST['startExecutedDateHour'].':'.$_POST['startExecutedDateMinute'];
    $this->Model_aktivitas->insert($data);
    echo "{result: 'ok'}";
  }

  function list_data()
  {
    $q_result = $this->Model_aktivitas->list_all(); 
    $data['objects'] = $q_result->result_array();
    $this->load->view('jsonizer', $data);
  }

  function list_activity_type()
  {
    $q_result = $this->Model_enum_params->list_activity_type(); 
    $data['objects'] = $q_result->result_array();
    $this->load->view('jsonizer', $data);
  }

}
?>
