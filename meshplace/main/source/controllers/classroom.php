<?php

class classroom extends controller {

    public function __construct($param) {
        parent::__construct($param);
        scurity::page_cache('Tue, 01 Jan 2000 00:00:00');
        myprotection::login(true);
    }

    private $title = 'Data Kelas';

    public function index() {
        $this->view->title_page = $this->title;
        $this->view->app = $this->app_model->otor_apps();
        $this->view->modul = $this->app_model->otor_moduls();
        $this->view->data_source = url::base('classroom/load');

        $this->view->button_action = array(
            url::anchor('<i class="icon-plus-sign"></i> Tambah', 'classroom/add', false, array('class' => 'btn'))
        );

        $this->view->render('classroom/main');
    }

    public function load() {

        $page = $this->input->get('page');
        $limit = 10;

        $list = $this->model->classroom_list(array(), $limit, $page * $limit - $limit);
        $total = $this->model->classroom_list()->num_rows();

        $data = array();
        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['total'] = $total;
        $data['rows'] = array();

        foreach ($list->objects() as $row) {

            $temp_id = md5($row->classroom_id);

            $action = url::anchor('<i class="icon-search"></i>', 'classroom/detail/' . $temp_id, false, array('class' => 'btn', 'title' => 'Detail'));
            $action .= url::anchor('<i class="icon-edit"></i>', 'classroom/edit/' . $temp_id, false, array('class' => 'btn', 'title' => 'Edit'));
            $action .= url::anchor('<i class="icon-remove"></i>', false, false, array('class' => 'btn', 'title' => 'Delete', 'onclick' => 'delete_row(\'' . url::base('classroom/delete/' . $temp_id) . '\')'));

            $data['rows'][] = array(
                'id' => $row->classroom_id,
                'title' => $row->classroom_name,
                'status' => ($row->status) ? 'Aktif' : 'Tidak Aktif',
                'action' => $action
            );
        }
        myprotection::xhr_result($data);
    }

    public function load_history() {

        $page = $this->input->get('page');
        $period = $this->input->get('period');


        $limit = 10;

        if (empty($period))
            $period = 0;

        $condition = array(array('a.period_id', '=', $period));
        $list = $this->model->classhistory_list($condition, $limit, $page * $limit - $limit);
        $total = $this->model->classhistory_list($condition)->num_rows();

        $data = array();
        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['total'] = $total;
        $data['rows'] = array();

        foreach ($list->objects() as $row) {

            $temp_id = md5($row->classroom_id);

            $action = url::anchor('<i class="icon-edit"></i>', 'classroom/edit/' . $temp_id, false, array('class' => 'btn', 'title' => 'Edit'));
            $action .= url::anchor('<i class="icon-remove"></i>', false, false, array('class' => 'btn', 'title' => 'Delete', 'onclick' => 'delete_row(\'' . url::base('classroom/delete/' . $temp_id) . '\')'));

            $data['rows'][] = array(
                'id' => $row->classroom_id,
                'nis' => $row->nis,
                'name' => $row->name,
                'gender' => $row->gender_name,
                'status' => ($row->status) ? 'Aktif' : 'Tidak Aktif',
                'action' => $action
            );
        }
        myprotection::xhr_result($data);
    }

    public function add($id = 0) {

        asset::js()->plugin('jquery.form');
        asset::js()->plugin('jquery.valiation');
        asset::js()->plugin('icheck');

        $this->load->helper('form');

        $this->view->title_page = $this->title;
        $this->view->app = $this->app_model->otor_apps();
        $this->view->modul = $this->app_model->otor_moduls();

        $this->view->form_action = url::base('classroom/proses');

        if (empty($id)) {
            $button_action = array(
                url::anchor('<i class="icon-circle-arrow-left"></i> Kembali', 'classroom', false, array('class' => 'btn'))
            );

            $this->view->title_form = 'Form Tambah';
        } else {

            $data = $this->model->classroom_list(array(array('MD5(classroom_id)', '=', $id)));
            $default = array();
            if ($data->num_rows()) {
                $row = $data->row();
                $default = array(
                    'id' => md5($row->classroom_id),
                    'title' => $row->classroom_name,
                    'status' => ($row->status) ? 'on' : 'off'
                );
            }

            $this->view->default = $default;

            $button_action = array(
                url::anchor('<i class="icon-circle-arrow-left"></i> Kembali', 'classroom', false, array('class' => 'btn')),
                url::anchor('<i class="icon-remove-sign"></i> Hapus', 'classroom/delete/' . $id, false, array('class' => 'btn'))
            );
            $this->view->title_form = 'Form Edit';
        }

        $this->view->button_action = $button_action;

        $this->view->render('classroom/form');
    }

    public function edit($id) {
        $this->add($id);
    }

    public function add_classhistory($classroom_id, $id = 0) {

        asset::js()->plugin('jquery.form');
        asset::js()->plugin('jquery.valiation');
        asset::js()->plugin('icheck');
        asset::js()->plugin('select2');

        $this->load->helper('form');
        $data = $this->model->classroom_list(array(array('MD5(classroom_id)', '=', $id)));
        if ($data->num_rows()) {
            
            $this->load->model('period');
            
            $row = $data->row();

            $this->view->title_page = $this->title . ' ' . $row->classroom_name;
            $this->view->app = $this->app_model->otor_apps();
            $this->view->modul = $this->app_model->otor_moduls();

            $this->view->form_action = url::base('classroom/proses');
            $this->view->period_options = $this->period_model->period_options();

            if (empty($id)) {
                $button_action = array(
                    url::anchor('<i class="icon-circle-arrow-left"></i> Kembali', 'classroom/detail/' . $classroom_id, false, array('class' => 'btn'))
                );

                $this->view->title_form = 'Form Tambah';
                
            } else {

                $data = $this->model->classroom_list(array(array('MD5(classroom_id)', '=', $id)));
                $default = array();
                if ($data->num_rows()) {
                    $row = $data->row();
                    $default = array(
                        'id' => md5($row->classroom_id),
                        'title' => $row->classroom_name,
                        'status' => ($row->status) ? 'on' : 'off'
                    );
                }

                $this->view->default = $default;

                $button_action = array(
                    url::anchor('<i class="icon-circle-arrow-left"></i> Kembali', 'classroom', false, array('class' => 'btn')),
                    url::anchor('<i class="icon-remove-sign"></i> Hapus', 'classroom/delete/' . $id, false, array('class' => 'btn'))
                );
                $this->view->title_form = 'Form Edit';
            }
            
            $this->view->student_options = array();
            $this->view->button_action = $button_action;
            $this->view->render('classroom/form_classhistory');
        }
    }

    public function edit_classhistory($classroom_id, $id) {
        $this->add($id);
    }

    public function detail($id) {
        $this->load->helper('form');

        $data = $this->model->classroom_list(array(array('MD5(classroom_id)', '=', $id)));
        if ($data->num_rows()) {
            $row = $data->row();

            $this->view->title_page = $this->title . ' ' . $row->classroom_name;
            $this->view->app = $this->app_model->otor_apps();
            $this->view->modul = $this->app_model->otor_moduls();

            $this->view->data_source = url::base('classroom/load_history');
            $this->view->button_action = array(
                url::anchor('<i class="icon-plus-sign"></i> Tambah', 'classroom/add_classhistory/' . $id, false, array('class' => 'btn'))
            );

            $this->load->model('period');

            $this->view->period_options = $this->period_model->period_options();

            $this->view->render('classroom/detail');
        }
    }

    public function proses() {
        $id = $this->input->post('id');
        $title = $this->input->post('title', 'Nama Kelas', array('requaired' => true));
        $status = $this->input->post('status', 'Status', array('requaired' => true));

        if ($this->input->validation()) {

            $data = array(
                'classroom_name' => $title,
                'status' => ($status == 'on') ? 1 : 0
            );

            $message = array(false, true, 'Data gagal disimpan.');
            if (empty($id)) {
                if ($this->model->save_create($data)) {
                    $message = array(true, true, '<b>Data berhasil disimpan!</b> <br>Apakah anda akan menambahkan data baru lagi?', url::base('classroom'));
                }
            } else {
                $condition = array(array('MD5(classroom_id)', '=', $id));
                if ($this->model->save_update($data, $condition)) {
                    $message = array(true, false, '<b>Data berhasil disimpan!</b> <br>Apakah data akan dirubah lagi?', url::base('classroom'));
                }
            }
        } else {
            $message = array(false, true, $this->input->validation_message());
        }

        myprotection::xhr_result($message);
    }

    public function delete($id) {
        $message = false;
        if ($this->model->delete($id)) {
            $message = true;
        }
        echo json_encode($message);
    }
    
    public function get_student() {
        
        $options = '<option value="1" selected="selected">Hellow World</option>';
        $options .= '<option value="2" selected="selected">Ucing Garong</option>';
        myprotection::xhr_result($options);
    }

}

?>
