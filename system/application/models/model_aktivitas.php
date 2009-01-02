<?php
class Model_aktivitas extends Model {
  function Model_aktivitas()
  {
    parent::Model();
  }

  function insert($data)
  {
    $this->db->insert('aktivitas', $data);
  }

  function list_all()
  {
    $this->db->orderby('start_executed_date', 'asc');
    return $this->db->get('aktivitas');
  }
}
?>

