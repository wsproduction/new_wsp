<?php

class controller {

    private static $instance;

    public function __construct($param) {
        self::$instance = $this;
        $this->load = new load($param);
        $this->view = new view($param);
        $this->autoload($param);
        session::init();
    }

    public static function get_instance() {
        return self::$instance;
    }

    private function autoload($param) {

        // Autoload Libraries
        $temp_libraries = array();
        foreach ($param['config']['autoload']['libraries'] as $value) {
            if (!in_array($value, $temp_libraries)) {
                $this->load->library($value);
                $temp_libraries[] = $value;
            }
        }

        // Autoload Libraries
        $temp_helpers = array();
        foreach ($param['config']['autoload']['helpers'] as $value) {
            if (!in_array($value, $temp_helpers)) {
                $this->load->helper($value);
            }
        }

        // Autoload Model
        $temp_models = array();
        $this->load->model($param['model_name'], 'model');
        foreach ($param['config']['autoload']['models'] as $value) {
            if (!in_array($value, $temp_models)) {
                $this->load->model($value);
                $temp_models[] = $value;
            }
        }
    }

}

?>
