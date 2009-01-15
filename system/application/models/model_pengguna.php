<?php
class Model_pengguna extends Model {
  function Model_pengguna()
  {
    parent::Model();
  }

  function insert($data)
  {
    $this->db->insert('pengguna', $data);
  }

  function list_all()
  {
    return $this->db->get('pengguna');
  }

  function get_pengguna($username)
  {
    $this->db->where('user_name', $username);
    return $this->db->get('pengguna');
  }
}
?>

