<?php

class job_model extends model {

    public function __construct($param) {
        parent::__construct($param);
    }

    private $db_job = 'm_job';

    public function gender_list($where = array(), $limit = -1, $ofset = -1) {
        $this->db->from($this->db_job);
        if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        if ($limit >= 0 && $ofset >= 0)
            $this->db->limit($limit, $ofset);
        return $this->db->fetch();
    }

    public function save_create($data) {
        $data['period_id'] = 'SQL[' . mygenerator::sql_wiht_id('int', $this->db_job, 'job_id') . ']';
        return $this->db->insert($this->db_job, $data);
    }

    public function save_update($data, $condition) {
        return $this->db->update($this->db_job, $data, $condition);
    }
    
    public function delete($id) {
        return $this->db->delete($this->db_job, array(array('job_id', '=', $id)));
    }
    
    public function job_options() {
        $option = array('' => ' --- Pilih ---');
        foreach ($this->gender_list()->objects() as $row) {
            $option[$row->job_id] = $row->job_name;
        }
        return $option;
    }

}

?>
