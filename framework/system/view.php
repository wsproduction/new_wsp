<?php

class view {

    private $param;

    public function __construct($param) {
        $this->param = $param;
    }

    public function render($views = '') {
        $theme = $this->param['application']['themes']['path'] . '/layout.php';
        $view = $this->param['source_path'] . '/views/' . $views . '.php';
        if (file_exists($theme)) {
            if (file_exists($view)) {
                $this->generate($theme, $view);
            } else {
                echo 'View tidak ditemukan';
            }
        } else {
            echo 'Layout tidak ditemukan';
        }
    }

    private function generate($theme, $view) {

        // Mengambil semua variable yang sudah di daftarkan di Class Object
        $load_vars = object::load_vars();
        foreach ($load_vars['view'] as $var => $value) {
            $$var = $value;
        }

        $layout = file_get_contents($theme);
        $view = file_get_contents($view);

        $str = str_replace($this->param['config']['main']['view']['main_view'], $view, $layout);
        if ($this->param['config']['main']['view']['wrapping']) {
            $out = $this->wrapping($str);
        } else {
            $out = $str;
        }

        $filename = $this->param['application']['logs']['path'] . '/wsf' . time() . str_shuffle(time()) . '.php';
        $file = fopen($filename, 'a');
        fwrite($file, $out);
        fclose($file);

        require($filename);

        if (file_exists($filename)) {
            unlink($filename);
        }
    }

    private function wrapping($str) {
        // Merubah koding menjadi 1 baris
        $remove = array("\n", "\r\n", "\r");
        $new_str = str_replace($remove, '', $str);
        $new_str = preg_replace("/[\t\s]+/", " ", trim($new_str));
        $new_str = str_replace('> ', '>', $new_str);
        $new_str = str_replace('<?php', '<?php ', $new_str);
        return $new_str;
    }

}