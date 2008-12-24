<?php
class Model_kontak extends Model {
  function Model_kontak()
  {
    parent::Model();
  }

  function insert($data)
  {
    $this->db->insert('kontak', $data);
  }

  function list_all()
  {
    return $this->db->get('kontak');
  }
}
?>

