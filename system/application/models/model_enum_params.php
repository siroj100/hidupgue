<?php
class Model_enum_params extends Model {
  function Model_enum_params()
  {
    parent::Model();
  }

  function list_activity_type()
  {
    $this->db->select('id, enum_value, enum_value_desc');
    $this->db->where('enum_class','TIPE_AKTIVITAS');
    $this->db->orderby('enum_value','asc');
    return $this->db->get('enum_params');
  }
}
?>

