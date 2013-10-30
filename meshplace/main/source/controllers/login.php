<?php

class login extends controller {

    public function __construct($param) {
        parent::__construct($param);
        scurity::page_cache('Tue, 01 Jan 2000 00:00:00');
        myprotection::login(false);
    }

    public function index() {
        asset::js()->plugin('jquery.form');
        asset::js()->plugin('jquery.valiation');
        asset::js()->plugin('icheck');

        $this->load->helper('form');
        $this->view->action_login = url::base('login/run');
        $this->view->render('login/main');
    }

    public function run() {

        $username = $this->input->post('uemail', 'Username', array('requaired' => true));
        $password = $this->input->post('upw', 'Password', array('requaired' => true));

        if ($this->input->validation()) {
            $this->load->model('user');
            $user = $this->user_model->user_login($username, $password);
            $user_data = $user->row();
            if ($user_data) {
                $session = array(
                    'sess_login' => true,
                    'sess_userdata' => array(
                        'user_id' => $user_data->user_id,
                        'email' => $user_data->email,
                    )
                );
                session::set($session);
                $message = array(true, true, url::base('home'));
            } else {
                $message = array(false, true, 'pesan error');
            }
        } else {
            $message = array(false, true, $this->input->validation_message());
        }

        myprotection::xhr_result($message);
    }

    public function stop() {
        session::destroy();
        url::redirect('login');
    }

}

?>
