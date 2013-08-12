<?php

/*
 * Hello World?
 * My name Warman Suganda, Welcome to my Helper.
 * Enjoyed, ^_^
 */

/*
 * Class Name : jsHelper
 * Descrition : Untuk optimasi pemanggilan javascript pada halaman website
 * Author : Warman Suganda
 * Email : warman.suganda@gmail.com
 */

class __js_helper {

    private static $js_plugin = array();
    private static $js_append = array();
    private static $param;

    function __construct($param) {
        self::$param = $param;
    }

    /*
     * Method Name : plugin
     * Description : untuk memudahkan pemanggilan framework javascript yang terdapat pada asset
     */

    public static function plugin($name = '') {
        /*
         * Daftar Plugin
         * Format untuk mendaftarkan plugin
         * array( 
         * 	  'nama_plugin' => array(
         * 			'js' => array(
         * 				'nama_file_js1',
         * 				'nama_file_js2'
         * 			),
         * 			'css' => array(
         * 				'nama_file_css1',
         * 				'nama_file_css2'
         * 			)
         * 	   )
         * )
         */
        $plugin_list = array(
            'jquery' => array(
                'js' => array(
                    'jquery-1.8.2.min'
                )
            ),
            'jquery.ui' => array(
                'js' => array(
                    'jquery-ui-1.9.1.custom.min'
                ),
                'css' => array(
                    'jquery.ui/flick/jquery-ui-1.9.1.custom.min'
                )
            ),
            'jquery.validation' => array(
                'js' => array(
                    'jquery.validate',
                    'jquery.validate.custom',
                )
            ),
            'jquery.form' => array(
                'js' => array(
                    'jquery.form',
                )
            ),
            'jquery.base' => array(
                'js' => array(
                    'jquery.base64.min',
                )
            )
        );

        /*
         * Me'looping daftar plugin untuk mencocokan nama plugin yang dipanggil
         */
        $idx = 0;
        foreach ($plugin_list as $key => $value) {
            if ($key == $name) {
                /*
                 * Mendaftarkan file javascript jika ada yang disertakan kedalam plugin
                 */
                if (isset($value['js'])) {
                    $alpha = 'a';
                    foreach ($value['js'] as $js) {
                        $index = $idx . $alpha;
                        self::set_plugin($index, $js);
                        $alpha++;
                    }
                }

                /*
                 * Mendaftarkan file css jika ada yang disertakan kedalam plugin
                 */
                if (isset($value['css'])) {
                    foreach ($value['css'] as $css) {
                        __css_helper::append($css, self::$param['framework']['url'] . '/asset/css');
                    }
                }

                /*
                 * Jika nama plugin yang dipanggil sama dengan index name daftar plugin proses looping dihentikan
                 */
                break;
            }
            $idx++;
        }
    }

    /*
     * Method Name : set_plugin
     * Description : untuk mendaftarkan javascript yang akan disediakan pada framework
     */

    private static function set_plugin($order = 0, $name = '', $source = '') {
        if ($order) {
            if (!array_key_exists($order, self::$js_plugin))
                self::$js_plugin[$order] = array('name' => $name, 'source' => $source);
        }
    }

    public static function append($name = '', $source = '') {
        self::$js_append[] = array('name' => $name, 'source' => $source);
    }

    public static function load() {
        $js = '';
        $js .= self::join(self::$js_plugin, self::$param['framework']['url'] . '/asset/js');
        $js .= self::join(self::$js_append, self::$param['application']['themes']['url'] . '/js');
        return $js;
    }

    private static function join($list = array(), $default_url = '') {
        $js = '';
        ksort($list);
        foreach ($list as $value) {
            $src = $default_url;
            if (!empty($value['source']))
                $src = $value['source'];

            $js .= '<script type="text/javascript" src="' . $src . '/' . $value['name'] . '.js"></script>';
        }
        return $js;
    }

}

/*
 * Class Name : cssHelper
 * Descrition : Untuk optimasi pemanggilan css pada halaman website
 * Author : Warman Suganda
 * Email : warman.suganda@gmail.com
 */

class __css_helper {

    private static $css_append = array();
    private static $param;

    function __construct($param) {
        self::$param = $param;
    }

    public static function append($name = '', $source = '') {
        self::$css_append[] = array('name' => $name, 'source' => $source);
    }

    public static function load() {
        $css = '';
        $css .= self::join(self::$css_append);
        return $css;
    }

    private static function join($list = array()) {
        $css = '';
        ksort($list);
        foreach ($list as $value) {
            $src = self::$param['application']['themes']['url'] . '/css';
            if (!empty($value['source']))
                $src = $value['source'];

            $css .= '<link rel="stylesheet" href="' . $src . '/' . $value['name'] . '.css" type="text/css" />';
        }
        return $css;
    }

}

/*
 * Class Name : imgHelper
 * Descrition : Untuk optimasi pemanggilan image pada halaman website
 * Author : Warman Suganda
 * Email : warman.suganda@gmail.com
 */

class __image_helper {

    private static $file_directory;
    private static $param;

    function __construct($param) {
        self::$param = $param;
        self::$file_directory = $param['application']['themes']['url'] . '/images/';
    }

    public static function load($filename = '', $directory = '', $attribut = array()) {

        $dir = self::$file_directory;
        if (!empty($directory))
            $dir = $directory;

        $src = $dir . $filename;

        $attr = '';
        foreach ($attribut as $key => $val)
            $attr .= $key . '="' . $val . '" ';

        return '<img src="' . $src . '" ' . $attr . '/>';
    }

    public static function fav_icon($filename = '', $directory = '', $attribut = array()) {

        $dir = self::$file_directory;
        if (!empty($directory))
            $dir = $directory;

        $src = $dir . $filename;

        $attr = '';
        foreach ($attribut as $key => $val)
            $attr .= $key . '="' . $val . '" ';

        return '<link rel="icon" href="' . $src . '" ' . $attr . '/>';
    }

}

/*
 * Class Name : asset
 * Descrition : Untuk optimasi pemanggilan asset
 * Author : Warman Suganda
 * Email : warman.suganda@gmail.com
 */

class asset extends helper {

    function __construct() {
        parent::__construct();
    }

    /*
     * Method untuk memanggil class jsHelper
     */

    public static function js() {
        return new __js_helper(parent::$param);
    }

    /*
     * Method untuk memanggil class cssHelper
     */

    public static function css() {
        return new __css_helper(parent::$param);
    }

    /*
     * Method untuk memanggil class imageHelper
     */

    public static function image() {
        return new __image_helper(parent::$param);
    }

    /*
     * Method untuk men'generate javascipt & css
     */

    public static function jcss() {
        $js = self::js()->load();
        $css = self::css()->load();
        return $css . ' ' . $js;
    }

}

?>