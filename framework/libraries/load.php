<?php

class load {

    private $param;

    public function __construct($param) {
        $this->param = $param;
    }

    public function model($name, $alias = '') {
        $name .= '_model';
        $model = $this->param['source_path'] . '/models/' . $name . '.php';
        if (file_exists($model)) {
            require_once($model);
            if (class_exists($name)) {
                $controller = controller::get_instance();
                if (!empty($alias))
                    $controller->{$alias} = new $name($this->param);
                else
                    $controller->{$name} = new $name($this->param);
            } else {
                // Tampilakan pesan error
                // exit;
                return false;
            }
        }
    }

    public function helper($name) {
        $helper_path = $this->param['framework']['path'] . '/helpers';
        $alternative_helper_path = $this->param['application']['source']['path'] . '/helpers';
        if (is_array($name)) {
            $list = $name;
        } else {
            $list = array($name);
        }
        $this->loader($helper_path, $list, '', $alternative_helper_path);
    }

    public function library($name) {
        $library_path = $this->param['framework']['path'] . '/libraries';
        $temp_name = array($name);
        $this->loader($library_path, $temp_name);
        if (class_exists($name)) {
            $controller = controller::get_instance();
            $controller->{$name} = new $name($this->param);
        } else {
            // Tampilakan pesan error
            // exit;
            return false;
        }
    }

    private function loader($path, $list, $prefix = '', $alternative_path = '') {
        $temp = array();
        foreach ($list as $value) {

            if (!empty($prefix)) {
                $value .= $prefix;
            }

            $file = $path . '/' . $value . '.php';
            if (!in_array($value, $temp)) {
                $temp[] = $value;
                if (file_exists($file)) {
                    require_once($file);
                } else {
                    if (!empty($alternative_path)) {
                        $file = $alternative_path . '/' . $value . '.php';
                        if (file_exists($file)) {
                            require_once($file);
                        }
                    }
                }
            }
        }
    }

}