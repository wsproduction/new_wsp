<?php

class student extends controller {

    public function __construct($param) {
        parent::__construct($param);
        scurity::page_cache('Tue, 01 Jan 2000 00:00:00');
        myprotection::login(true);
    }

    private $title = 'Data Siswa';

    public function index() {
        $this->view->title_page = $this->title;
        $this->view->app = $this->app_model->otor_apps();
        $this->view->modul = $this->app_model->otor_moduls();
        $this->view->data_source = url::base('student/load');

        $this->view->button_action = array(
            url::anchor('<i class="icon-plus-sign"></i> Tambah', 'student/add', false, array('class' => 'btn'))
        );

        $this->view->render('student/main');
    }

    public function load() {

        $page = $this->input->get('page');
        $limit = 10;

        $list = $this->model->student_list(array(), $limit, $page * $limit - $limit);
        $total = $this->model->student_list()->num_rows();

        $data = array();
        $data['page'] = $page;
        $data['limit'] = $limit;
        $data['total'] = $total;
        $data['rows'] = array();

        foreach ($list->objects() as $row) {

            $action = url::anchor('<i class="icon-search"></i>', 'student/detail/' . $row->nis, false, array('class' => 'btn', 'title' => 'Detail'));
            $action .= url::anchor('<i class="icon-edit"></i>', 'student/edit/' . $row->nis, false, array('class' => 'btn', 'title' => 'Edit'));
            $action .= url::anchor('<i class="icon-remove"></i>', false, false, array('class' => 'btn', 'title' => 'Delete', 'onclick' => 'delete_row(\'' . url::base('student/delete/' . $row->nis) . '\')'));

            $data['rows'][] = array(
                'nis' => $row->nis,
                'name' => $row->name,
                'gender' => $row->gender_title,
                'period' => $row->period,
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
        asset::js()->plugin('form.wizard');
        asset::js()->plugin('datepicker');
        asset::js()->plugin('chosen');
        asset::js()->plugin('maskedinput');

        $this->load->helper('form');
        $this->load->model('gender');
        $this->load->model('religion');
        $this->load->model('residance');
        $this->load->model('distance');
        $this->load->model('transportation');
        $this->load->model('special_needs');
        $this->load->model('job');
        $this->load->model('education');
        $this->load->model('income');
        $this->load->model('period');
        
        $this->view->title_page = $this->title;
        $this->view->app = $this->app_model->otor_apps();
        $this->view->modul = $this->app_model->otor_moduls();
        
        $this->view->list_step = array('Data Diri', 'Data Orang Tua / Wali', 'Data Pendidikan');
        $this->view->list_parent = array('ayah' => 'Ayah', 'ibu' => 'Ibu', 'wali' => 'Wali');
        $this->view->gender = $this->gender_model->gender_options();
        $this->view->religion = $this->religion_model->religion_options();
        $this->view->residance = $this->residance_model->residance_options();
        $this->view->distance = $this->distance_model->distance_options();
        $this->view->transportation = $this->transportation_model->transportation_options();
        $this->view->special_needs = $this->special_needs_model->special_needs_options();
        $this->view->job = $this->job_model->job_options();
        $this->view->education = $this->education_model->education_options();
        $this->view->income = $this->income_model->income_options();
        $this->view->period = $this->period_model->period_options();

        $this->view->form_action = url::base('student/proses');
        $this->view->wizard_step = array(1 => 'Biodata', 2 => 'Data Tempat Tinggal');

        if (empty($id)) {
            $button_action = array(
                url::anchor('<i class="icon-circle-arrow-left"></i> Kembali', 'student', false, array('class' => 'btn'))
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
                url::anchor('<i class="icon-circle-arrow-left"></i> Kembali', 'student', false, array('class' => 'btn')),
                url::anchor('<i class="icon-remove-sign"></i> Hapus', 'student/delete/' . $id, false, array('class' => 'btn'))
            );
            $this->view->title_form = 'Form Edit';
        }

        $this->view->button_action = $button_action;

        $this->view->render('student/form');
    }

    public function detail($id = 0) {

        asset::js()->plugin('jquery.form');
        asset::js()->plugin('jquery.valiation');
        asset::js()->plugin('icheck');
        asset::js()->plugin('custom.upload');
        asset::js()->plugin('form.wizard');

        $this->load->helper('form');

        $this->view->title_page = $this->title;
        $this->view->app = $this->app_model->otor_apps();
        $this->view->modul = $this->app_model->otor_moduls();

        $this->view->form_action = url::base('period/proses');

        if (empty($id)) {
            $button_action = array(
                url::anchor('<i class="icon-circle-arrow-left"></i> Kembali', 'student', false, array('class' => 'btn'))
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
                url::anchor('<i class="icon-circle-arrow-left"></i> Kembali', 'student', false, array('class' => 'btn')),
                url::anchor('<i class="icon-remove-sign"></i> Hapus', 'student/delete/' . $id, false, array('class' => 'btn'))
            );
            $this->view->title_form = 'Form Edit';
        }

        $this->view->button_action = $button_action;

        $this->view->render('student/form');
    }

    public function edit($id) {
        $this->add($id);
    }

    public function proses() {
        $id = $this->input->post('id');
        
        $period = $this->input->post('period', 'Tahun Masuk', array('requaired' => true));
        $nis = $this->input->post('nis', 'NIS', array('requaired' => true));
        $nisn = $this->input->post('nisn');
        $name = $this->input->post('name', 'Nama Lengkap', array('requaired' => true));
        $gender = $this->input->post('gender', 'Jenis Kelamin', array('requaired' => true));
        $birthplace = $this->input->post('birthplace', 'Tempat Lahir', array('requaired' => true));
        $birthdate = $this->input->post('birthdate', 'Tanggal Lahir', array('requaired' => true));
        $religion = $this->input->post('religion', 'Agama', array('requaired' => true));
        $residance = $this->input->post('residance', 'Tempat Tinggal', array('requaired' => true));
        $address = $this->input->post('address', 'Alamat', array('requaired' => true));
        $zipcode = $this->input->post('zipcode', 'Kode Pos', array('requaired' => true));
        $distance = $this->input->post('distance');
        $transportation = $this->input->post('transportation');
        $hp = $this->input->post('hp');
        $email = $this->input->post('email');
        $height = $this->input->post('height');
        $weight = $this->input->post('weight');
        $special_needs = $this->input->post('special_needs');

        if ($this->input->validation()) {

            $data = array(
                'name' => $name,
                'gender' => $gender,
                'nis' => $nis,
                'nisn' => $nisn,
                'birthplace' => $birthplace,
                'birthdate' => date('Y-m-d', strtotime($birthdate)),
                'religion' => $religion,
                'residance' => $residance,
                'address' => $address,
                'zipcode' => $zipcode,
                'distance' => $distance,
                'transportation' => $transportation,
                'phonenumber' => $hp,
                'email' => $email,
                'height' => $height,
                'weight' => $weight,
                'specialneeds' => $special_needs,
                'period_at' => $period,
                'status' => 1
            );

            $message = array(false, true, 'Data gagal disimpan.');
            if (empty($id)) {                
                if ($this->model->save_create($data)) {
                    $message = array(true, true, '<b>Data berhasil disimpan!</b> <br>Apakah anda akan menambahkan data baru?', url::base('student'));
                }
            } else {
                $condition = array(array('period_id', '=', $id));
                if ($this->model->save_update($data, $condition)) {
                    $message = array(true, false, '<b>Data berhasil disimpan!</b> <br>Apakah data akan dirubah?', url::base('student'));
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
