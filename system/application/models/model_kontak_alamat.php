<?php
class Model_kontak_alamat extends Model {
  function Model_kontak_alamat()
  {
    parent::Model();
  }

  function insert($data)
  {
    $this->db->insert('kontak_alamat', $data);
  }

  function list_all()
  {
    return $this->db->get('kontak_alamat');
  }
}
?>

