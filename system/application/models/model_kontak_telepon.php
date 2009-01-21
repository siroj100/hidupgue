<?php
class Model_kontak_telepon extends Model {
  function Model_kontak_telepon()
  {
    parent::Model();
  }

  function find_contact_by_phone_number($phone_number, $pengguna_id)
  {
    $this->db->where('kontak.pengguna_id', $pengguna_id);
    $this->db->like('kontak.phone_number', $phone_number);
    return $this->db->get('kontak_telepon');
  }

  function get_primary_phone($kontak_id, $pengguna_id)
  {
    $this->db->select('kontak_telepon.id, kontak_telepon.phone_number');
    $this->db->where('kontak.id', $kontak_id);
    $this->db->where('kontak.pengguna_id', $pengguna_id);
    $this->db->where('kontak_telepon.primary_flag = TRUE');
    $this->db->from('kontak');
    $this->db->join('kontak_telepon','kontak_telepon.kontak_id = kontak.id');
    return $this->db->get();
  }

  function phone_count($kontak_id, $pengguna_id)
  {
    $this->db->where('kontak.id', $kontak_id);
    $this->db->where('kontak.pengguna_id', $pengguna_id);
    $this->db->where('kontak_phone.phone_number IS NOT NULL');
    $this->db->from('kontak');
    $this->db->join('kontak_telepon','kontak_phone.kontak_id = kontak.id');
    return $this->db->count_all_results();
  }

  function insert($data)
  {
    $data['created_on'] = date('Y-m-d H:i:s');
    $this->db->insert('kontak_telepon', $data);
  }

  function update($kontak_id,$id,$data)
  {
    $this->db->where('kontak_id',$kontak_id);
    $this->db->where('id',$id);
    $this->db->update('kontak_telepon', $data);
  }

  function list_all($kontak_id=null)
  {
    if (isset($kontak_id)) {
      $this->db->where('kontak_id', $kontak_id);
    }
    $this->db->orderby('created_on', 'desc');
    return $this->db->get('kontak_telepon');
  }
}
?>

