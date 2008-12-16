<?php
class Model_catatan extends Model {
  function Model_catatan()
  {
    parent::Model();
  }

  function insert($data)
  {
    $this->db->insert('catatan', $data);
  }

  function list_all()
  {
    return $this->db->get('catatan');
  }
}
?>

