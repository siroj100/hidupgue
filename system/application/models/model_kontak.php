<?php
class Model_kontak extends Model {
  function Model_kontak()
  {
    parent::Model();
  }

  function get_kontak($kontak_id, $pengguna_id)
  {
    $this->db->where('kontak.id', $kontak_id);
    $this->db->where('kontak.pengguna_id', $pengguna_id);
    return $this->db->get('kontak');
  }

  function find_contact_by_name($name, $pengguna_id)
  {
    $this->db->select('kontak.id, name, email_address, phone_number');
    $this->db->like('kontak.name', $name);
    $this->db->where('kontak.pengguna_id', $pengguna_id);
    $this->db->where('kontak_email.primary_flag = TRUE');
    $this->db->where('kontak_telepon.primary_flag = TRUE');
    $this->db->from('kontak');
    $this->db->join('kontak_email','kontak_email.kontak_id = kontak.id','left');
    $this->db->join('kontak_telepon','kontak_telepon.kontak_id = kontak.id','left');
    return $this->db->get();
  }

  function insert($data)
  {
    $data['created_on'] = date('Y-m-d H:i:s');
    $this->db->insert('kontak', $data);
  }

  function list_all()
  {
    return $this->db->get('kontak');
  }

  function list_all_w_primary_details($pengguna_id)
  {
    $this->db->select('kontak.id, name, email_address, phone_number');
    $this->db->where('kontak.pengguna_id', $pengguna_id);
    $this->db->where('kontak_email.primary_flag = TRUE');
    $this->db->where('kontak_telepon.primary_flag = TRUE');
    $this->db->from('kontak');
    $this->db->join('kontak_email','kontak_email.kontak_id = kontak.id','left');
    $this->db->join('kontak_telepon','kontak_telepon.kontak_id = kontak.id','left');
    $this->db->group_by('kontak.id');
    return $this->db->get();
  }
}
?>

