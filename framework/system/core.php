<?php

class core {

    private $app;

    public function __construct($app) {
        $this->app = $app;
    }

    public function run() {
        $uri = $this->uri();
        $piece = explode('/', $uri);
        $app = $this->app;

        $idx = 1;
        $app_param = array();
        $is_child = false;

        if (isset($piece[0])) {
            $first_piece = $piece[0];
            if (isset($app['child'])) {
                foreach ($app['child'] as $row) {
                    if (isset($row['alias']) && $row['alias'] == $first_piece) {
                        $is_child = true;
                        $app_param = array(
                            'folder' => $row['folder'],
                            'themes' => array('name' => $row['themes']),
                        );
                        break;
                    }
                }
            }
        }

        if (!$is_child) {
            $idx = 0;
            $main = $app['main'];
            $app_param = array(
                'folder' => $main['folder'],
                'themes' => array('name' => $main['themes']),
            );
        }

        // include configuration
        $config_path = base_path . '/' . $app_param['folder'] . '/config';
        $main_config = require_once($config_path . '/main.php');
        $db_config = require_once($config_path . '/database.php');
        $autoload_config = require_once($config_path . '/autoload.php');

        $method = 'index'; // default method
        $arg_value = array(); // default argument

        if (isset($piece[$idx + 0]) && !empty($piece[$idx + 0])) {
            $controller = $piece[$idx + 0];
            if (isset($piece[$idx + 1]) && !empty($piece[$idx + 1])) {
                $method = $piece[$idx + 1];

                $arg_idx_loop = 2;
                $arg_status_loop = true;
                while ($arg_status_loop) {
                    if (isset($piece[$idx + $arg_idx_loop])) {
                        $arg_value[] = $piece[$idx + $arg_idx_loop];
                    } else {
                        $arg_status_loop = false;
                    }
                    $arg_idx_loop++;
                }
            }
        } else {
            $controller = $main_config['default_controller'];
        }

        // Load other system
        $system_list = array('controller', 'object', 'view', 'model');
        $system_path = base_path . '/' . framework_base . '/system';
        $this->loader($system_path, $system_list);

        // Set default autoload
        $autoload_config['helpers'][] = 'session';
        $autoload_config['helpers'][] = 'asset';

        $source_path = base_path . '/' . $app_param['folder'] . '/source';
        $page = $source_path . '/controllers/' . $controller . '.php';
        if (file_exists($page)) {
            require_once($page);
            if (class_exists($controller)) {

                // Mendeklarasikan parameter
                $dot_slash = $this->dot_slash($this->uri(false), $controller, $is_child);

                $app_param['attachment']['url'] = $dot_slash . $app_param['folder'] . '/asset/attachment';
                $app_param['logs']['path'] = base_path . '/' . $app_param['folder'] . '/asset/logs';
                $app_param['js']['url'] = $dot_slash . $app_param['folder'] . '/asset/js';
                $app_param['themes']['url'] = $dot_slash . $app_param['folder'] . '/asset/themes/' . $app_param['themes']['name'];
                $app_param['themes']['path'] = base_path . '/' . $app_param['folder'] . '/asset/themes/' . $app_param['themes']['name'];
                $app_param['source']['path'] = $source_path;

                $param = array(
                    'framework' => array(
                        'url' => $dot_slash . framework_base,
                        'path' => base_path . '/' . framework_base
                    ),
                    'application' => $app_param,
                    'config' => array(
                        'main' => $main_config,
                        'database' => $db_config,
                        'autoload' => $autoload_config
                    ),
                    'source_path' => $source_path,
                    'model_name' => $controller,
                    'host' => $_SERVER['SERVER_NAME'],
                    'base_path' => base_path,
                    'base_url' => $this->base_url()
                );

                // Load libraries
                $main_libraries = array('database', 'helper', 'load');
                $library_path = base_path . '/' . framework_base . '/libraries';
                $this->loader($library_path, $main_libraries);

                // set helpers parameters
                helper::$param = $param;
                
                // Class declaration
                $class_controller = new $controller($param);

                /*
                 * Mengambil semua variable yang ada di Controllers
                 * untuk di daftarkan di Class Object, supaya $variable tersebut
                 * dapat di panggil di Views
                 */ object::get_user_vars($class_controller);

                if (method_exists($class_controller, $method)) {
                    call_user_func_array(array($class_controller, $method), $arg_value);
                } else {
                    echo ' Method ' . $method . ' tidak ditemukan';
                }
            } else {
                echo 'Class tidak ditemukan!';
            }
        } else {
            echo 'Halaman tidak ditemukan!';
        }
    }

    private function uri($rtrim = true) {
        if (!isset($_SERVER['REQUEST_URI']) OR !isset($_SERVER['SCRIPT_NAME'])) {
            return '';
        }

        $uri = $_SERVER['REQUEST_URI'];
        if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0) {
            $uri = substr($uri, strlen($_SERVER['SCRIPT_NAME']));
        } elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0) {
            $uri = substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
        }
        if (strncmp($uri, '?/', 2) === 0) {
            $uri = substr($uri, 2);
        }
        $parts = preg_split('#\?#i', $uri, 2);
        $uri = $parts[0];
        if (isset($parts[1])) {
            $_SERVER['QUERY_STRING'] = $parts[1];
            parse_str($_SERVER['QUERY_STRING'], $_GET);
        } else {
            $_SERVER['QUERY_STRING'] = '';
            $_GET = array();
        }

        if ($uri == '/' || empty($uri)) {
            return '/';
        }

        $uri = parse_url($uri, PHP_URL_PATH);
        if ($rtrim) {
            return str_replace(array('//', '../'), '/', trim($uri, '/'));
        } else {
            return $uri;
        }
    }

    private function base_url() {
        $protocol = 'http://';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
            $protocol = 'http://';
        $url = $protocol;
        $url .= $_SERVER['SERVER_NAME'];
        $url .= rtrim($_SERVER['SCRIPT_NAME'], 'index.php');
        return $url;
    }

    private function dot_slash($uri, $controller, $is_child) {

        if ($uri != '/') {
            $get_slahs = preg_replace("/^\/{$controller}/", '', $uri);
            $count_slash = substr_count($get_slahs, '/');
            
            if ($is_child)
                $count_slash -= 1;
            
            if ($count_slash > 0) {
                $dot_slash = '';
                for ($i = 0; $i < $count_slash; $i++) {
                    $dot_slash .= '../';
                }
                return $dot_slash;
            } else {
                return '';
            }
        } else {
            return '';
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

?>
