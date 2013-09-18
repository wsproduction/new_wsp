<?php

class login extends controller {

    public function __construct($param) {
        parent::__construct($param);
        scurity::page_cache('Tue, 01 Jan 2000 00:00:00');
        myprotection::login(false);
    }

    public function index() {
        asset::js()->plugin('jquery.validation');
        asset::js()->plugin('jquery.form');
        asset::js()->plugin('jquery.base');

        $this->load->helper('form');

        $this->view->app = $this->app_model->app_list(1);
        $this->view->action_login = url::base('login/run');
        $this->view->render('login/index');
    }

    public function run() {

        $username = $this->input->post('username', 'title[Username]|requaired');
        $password = $this->input->post('password', 'title[Password]|requaired');

        if ($this->input->validation()) {
            $data = array(
                array('username', '=', $username),
                array('password', '=', md5($password))
            );
            $user = $this->model->user($data);
            $user_data = $user->row();
            if ($user_data) {
                $session = array(
                    'sess_login' => true,
                    'sess_userdata' => array(
                        'user_id' => $user_data->user_id,
                        'name' => $user_data->name,
                    )
                );
                session::set($session);
                $message = array(true, true, url::base('home'));
            } else {
                $message = array(false, true, base64_encode('pesan error'));
            }
        } else {
            $message = array(false, true, base64_encode($this->input->validation_message()));
        }

        echo json_encode($message);
    }

    public function stop() {
        session::destroy();
        url::redirect('login');
    }

}

?>
