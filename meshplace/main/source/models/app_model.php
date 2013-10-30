<?php

class app_model extends model {

    public function __construct($param) {
        parent::__construct($param);
    }

    private $db_app = 'm_application';
    private $db_modul = 'm_modul';

    public function app_list($where = array(), $limit = -1, $ofset = -1) {
        $this->db->from($this->db_app);
        if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        if ($limit >= 0 && $ofset >= 0)
            $this->db->limit($limit, $ofset);
        $this->db->order('app_order');
        return $this->db->fetch();
    }

    public function modul_list($where) {
        $this->db->from($this->db_modul);
        if (is_array($where) && count($where) > 0)
            $this->db->where($where);
        $this->db->order('modul_order');
        return $this->db->fetch();
    }

    public function otor_apps() {
        $where = array(
            array('app_status', '=', 1)
        );
        return $this->app_list($where);
    }

    public function otor_moduls() {
        $where = array(
            array('modul_status', '=', 1)
        );
        return $this->modul_list($where);
    }

}

?>
