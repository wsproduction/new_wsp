<?php

class gender_model extends model {

    public function __construct($param) {
        parent::__construct($param);
    }

    private $db_gender = 'm_gender';

    public function gender_list($where = array(), $limit = -1, $ofset = -1) {
        $this->db->from($this->db_gender);
        if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        if ($limit >= 0 && $ofset >= 0)
            $this->db->limit($limit, $ofset);
        $this->db->order('title');
        return $this->db->fetch();
    }

    public function save_create($data) {
        $data['period_id'] = 'SQL[' . mygenerator::sql_wiht_id('int', $this->db_gender, 'gender_id') . ']';
        return $this->db->insert($this->db_gender, $data);
    }

    public function save_update($data, $condition) {
        return $this->db->update($this->db_gender, $data, $condition);
    }
    
    public function delete($id) {
        return $this->db->delete($this->db_gender, array(array('gender_id', '=', $id)));
    }
    
    public function gender_options() {
        $option = array('' => ' --- Pilih ---');
        foreach ($this->gender_list()->objects() as $row) {
            $option[$row->gender_id] = $row->title;
        }
        return $option;
    }

}

?>
