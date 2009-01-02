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

