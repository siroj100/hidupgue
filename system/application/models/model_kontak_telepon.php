<?php
class Model_kontak_telepon extends Model {
  function Model_kontak_telepon()
  {
    parent::Model();
  }

  function insert($data)
  {
    $this->db->insert('kontak_telepon', $data);
  }

  function list_all()
  {
    return $this->db->get('kontak_telepon');
  }
}
?>

