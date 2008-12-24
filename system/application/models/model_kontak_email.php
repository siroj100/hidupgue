<?php
class Model_kontak_email extends Model {
  function Model_kontak_email()
  {
    parent::Model();
  }

  function insert($data)
  {
    $this->db->insert('kontak_email', $data);
  }

  function list_all()
  {
    return $this->db->get('kontak_email');
  }
}
?>

