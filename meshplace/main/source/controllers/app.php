<?php

class app extends controller {

    public function __construct($param) {
        parent::__construct($param);
        scurity::page_cache('Tue, 01 Jan 2000 00:00:00');
        myprotection::login(true);
    }

    public function index() {
        $this->view->title_page = 'Master Aplikasi';
        $this->view->app = $this->app_model->otor_apps();
        $this->view->modul = $this->app_model->otor_moduls();
        $this->view->data_source = url::base('app/load');
        $this->view->render('app/main');
    }

    public function load() {

        $page = $this->input->get('page');
        $limit = 10;

        $list = $this->model->app_list(array(), $limit, $page * $limit - $limit);
        $total = $this->model->app_list()->num_rows();

        $data = array();
        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['total'] = $total;
        $data['rows'] = array();

        foreach ($list->objects() as $row) {
            
            $action = url::anchor('<i class="icon-search"></i>', 'app/detail', false, array('class' => 'btn', 'title' => 'View'));
            $action .= url::anchor('<i class="icon-edit"></i>', 'app/edit', false, array('class' => 'btn', 'title' => 'Edit'));
            $action .= url::anchor('<i class="icon-remove"></i>', 'app/delete', false, array('class' => 'btn', 'title' => 'Delete'));
            
            $data['rows'][] = array(
                'id' => $row->app_id,
                'name' => $row->app_name,
                'desc' => $row->app_desc,
                'action' => $action
            );
        }
        myprotection::xhr_result($data);
    }
    
    public function add() {
        
        asset::js()->plugin('jquery.form');
        asset::js()->plugin('jquery.valiation');
        asset::js()->plugin('icheck');
        asset::js()->plugin('custom.upload');
        
        $this->view->title_page = 'Tambah Aplikasi';
        $this->view->app = $this->app_model->otor_apps();
        $this->view->modul = $this->app_model->otor_moduls();
        $this->view->data_source = url::base('app/load');
        $this->view->render('app/form');
    }
    
}

?>
