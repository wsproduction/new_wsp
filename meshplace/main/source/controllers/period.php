<?php

class period extends controller {

    public function __construct($param) {
        parent::__construct($param);
        scurity::page_cache('Tue, 01 Jan 2000 00:00:00');
        myprotection::login(true);
    }

    private $title = 'Tahun Pelajaran';

    public function index() {
        $this->view->title_page = $this->title;
        $this->view->app = $this->app_model->otor_apps();
        $this->view->modul = $this->app_model->otor_moduls();
        $this->view->data_source = url::base('period/load');

        $this->view->button_action = array(
            url::anchor('<i class="icon-plus-sign"></i> Tambah', 'period/add', false, array('class' => 'btn'))
        );

        $this->view->render('period/main');
    }

    public function load() {

        $page = $this->input->get('page');
        $limit = 10;

        $list = $this->model->period_list(array(), $limit, $page * $limit - $limit);
        $total = $this->model->period_list()->num_rows();

        $data = array();
        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['total'] = $total;
        $data['rows'] = array();

        foreach ($list->objects() as $row) {

            $action = url::anchor('<i class="icon-edit"></i>', 'period/edit/' . $row->period_id, false, array('class' => 'btn', 'title' => 'Edit'));
            $action .= url::anchor('<i class="icon-remove"></i>', false, false, array('class' => 'btn', 'title' => 'Delete', 'onclick' => 'delete_row(\'' . url::base('period/delete/' . $row->period_id) . '\')'));

            $data['rows'][] = array(
                'id' => $row->period_id,
                'title' => $row->title,
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
        asset::js()->plugin('custom.upload');

        $this->load->helper('form');

        $this->view->title_page = $this->title;
        $this->view->app = $this->app_model->otor_apps();
        $this->view->modul = $this->app_model->otor_moduls();

        $this->view->form_action = url::base('period/proses');

        if (empty($id)) {
            $button_action = array(
                url::anchor('<i class="icon-circle-arrow-left"></i> Kembali', 'period', false, array('class' => 'btn'))
            );

            $this->view->title_form = 'Form Tambah';
        } else {

            $data = $this->model->period_list(array(array('period_id', '=', $id)));
            $default = array();
            if ($data->num_rows()) {
                $row = $data->row();
                $default = array(
                    'id' => $row->period_id,
                    'title' => $row->title,
                    'status' => ($row->status) ? 'on' : 'off'
                );
            }

            $this->view->default = $default;

            $button_action = array(
                url::anchor('<i class="icon-circle-arrow-left"></i> Kembali', 'period', false, array('class' => 'btn')),
                url::anchor('<i class="icon-remove-sign"></i> Hapus', 'period/delete/' . $id, false, array('class' => 'btn'))
            );
            $this->view->title_form = 'Form Edit';
        }

        $this->view->button_action = $button_action;

        $this->view->render('period/form');
    }

    public function edit($id) {
        $this->add($id);
    }

    public function proses() {
        $id = $this->input->post('id');
        $title = $this->input->post('title', 'Tahun Pelajaran', array('requaired' => true));
        $status = $this->input->post('status', 'Status', array('requaired' => true));

        if ($this->input->validation()) {

            $data = array(
                'title' => $title,
                'status' => ($status == 'on') ? 1 : 0
            );

            $message = array(false, true, 'Pesan Error');
            if (empty($id)) {
                if ($this->model->save_create($data)) {
                    $message = array(true, true, 'Pesan Berhasil', url::base('period'));
                }
            } else {
                $condition = array(array('period_id', '=', $id));
                if ($this->model->save_update($data, $condition)) {
                    $message = array(true, false, 'Pesan Berhasil', url::base('period'));
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

}

?>
