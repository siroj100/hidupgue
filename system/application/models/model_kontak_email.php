<?php
class Model_kontak_email extends Model {
  function Model_kontak_email()
  {
    parent::Model();
  }

  function find_contact_by_email_address($email_address, $pengguna_id)
  {
    $this->db->where('kontak.pengguna_id', $pengguna_id);
    $this->db->like('kontak.email_address', $email_address);
    return $this->db->get('kontak_email');
  }

  function get_primary_email($kontak_id, $pengguna_id)
  {
    $this->db->select('kontak_email.id, kontak_email.email_address');
    $this->db->where('kontak.id', $kontak_id);
    $this->db->where('kontak.pengguna_id', $pengguna_id);
    $this->db->where('kontak_email.primary_flag = TRUE');
    $this->db->from('kontak');
    $this->db->join('kontak_email','kontak_email.kontak_id = kontak.id');
    return $this->db->get();
  }

  function email_count($kontak_id, $pengguna_id)
  {
    $this->db->where('kontak.id', $kontak_id);
    $this->db->where('kontak.pengguna_id', $pengguna_id);
    $this->db->where('kontak_email.email_address IS NOT NULL');
    $this->db->from('kontak');
    $this->db->join('kontak_email','kontak_email.kontak_id = kontak.id');
    return $this->db->count_all_results();
  }

  function insert($data)
  {
    $data['created_on'] = date('Y-m-d H:i:s');
    $this->db->insert('kontak_email', $data);
  }

  function update($kontak_id,$id,$data)
  {
    $this->db->where('kontak_id',$kontak_id);
    $this->db->where('id',$id);
    $this->db->update('kontak_email', $data);
  }

  function update_all($kontak_id,$data)
  {
    $this->db->where('kontak_id',$kontak_id);
    $this->db->update('kontak_email', $data);
  }

  function list_all($kontak_id=null)
  {
    if (isset($kontak_id)) {
      $this->db->where('kontak_id', $kontak_id);
    }
    $this->db->orderby('created_on', 'desc');
    return $this->db->get('kontak_email');
  }
}
?>

