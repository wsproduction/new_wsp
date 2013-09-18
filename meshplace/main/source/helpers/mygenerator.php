<?php

/*
 * Hello World?
 * My name Warman Suganda, Welcome to my Helper.
 * Enjoyed, ^_^
 */

/*
 * Class Name : mygenerator
 * Descrition : 
 * Author : Warman Suganda
 * Email : warman.suganda@gmail.com
 */

class mygenerator extends helper {

    public function __construct() {
        parent::__construct();
    }

    private static $nama_hari = array(
        'ina' => array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu')
    );
    private static $nama_bulan = array(
        'ina' => array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'),
        'eng' => array('January', 'February', 'March', 'April', 'Mey', 'June', 'July', 'August', 'September', 'October', 'November', 'December')
    );
    private static $meeting_status = array('Draft', 'Pengajuan', 'Belum Dilaksanakan',  'Ditolak', 'Sudah Dilaksanakan', 'Final');
    private static $agenda_status = array('Belum Dilaksanakan', 'Dilaksanakan', 'Tidak Dilaksanakan');

    public static function tanggal($date, $language = 'ina') {
        $hari = date('w', strtotime($date));
        $tanggal = date('d', strtotime($date));
        $bulan = date('m', strtotime($date));
        $tahun = date('Y', strtotime($date));

        $hasil = array();
        $hasil['tanggal'] = $tanggal;
        $hasil['tahun'] = $tahun;
        if (isset(self::$nama_hari[$language][$hari])) {
            $hasil['hari'] = self::$nama_hari[$language][$hari];
        }
        if (isset(self::$nama_bulan[$language][$bulan - 1])) {
            $hasil['bulan'] = self::$nama_bulan[$language][$bulan - 1];
        }
        return $hasil;
    }

    public static function monthNameToIndex($month_name, $language = 'ina', $precision = 1) {
        $index = 0;
        if (isset(self::$nama_bulan[$language])) {
            foreach (self::$nama_bulan[$language] as $key => $value) {
                if ($value == $month_name) {
                    $index = $key + 1;
                }
            }
        }

        if ($precision == 2) {
            if (strlen($index) == 1) {
                $index = '0' . $index;
            }
        }

        return $index;
    }

    public static function mnthName($index, $language = 'ina') {
        $month_name = '';
        if (self::$nama_bulan[$language][$index - 1]) {
            $month_name = self::$nama_bulan[$language][$index - 1];
        }
        return $month_name;
    }

    public static function monthNameTranslate($month_name, $from = 'eng', $to = 'ina') {
        $result = '';
        $index = self::monthNameToIndex($month_name, $from, 1);
        if ($index) {
            $result = self::mnthName($index, $to);
        }
        return $result;
    }
    
    public static function getMonthName($languge = 'ina') {
        $month = array();
        if (self::$nama_bulan[$languge]) {
            $month = self::$nama_bulan[$languge];
        }
        return $month;
    }

    public static function sizeFilter($bytes) {
        $label = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        for ($i = 0; $bytes >= 1024 && $i < ( count($label) - 1 ); $bytes /= 1024, $i++)
            ;
        return( round($bytes, 2) . " " . $label[$i] );
    }

    public static function toPercent($value, $total, $precision = 0) {
        if ($value > 0) {
            $percent = $value / $total * 100;
            $percent = round($percent, $precision);
        } else {
            $percent = 0;
        }
        return $percent;
    }

    public static function otherDiffDate($begin = '2020-06-09 10:30:00', $end = '2020-06-09 10:30:00', $out_in_array = false) {

        $db = new DateTime(date('Y-m-d H:i:s', strtotime($begin)));
        $de = new DateTime(date('Y-m-d H:i:s', strtotime($end)));

        $condotion = '';
        if ($db > $de)
            $condotion = '-';

        $intervalo = date_diff(date_create($begin), date_create($end));
        $out = 'Condition:' . $condotion . ',' . $intervalo->format("Years:%Y,Months:%M,Days:%d,Hours:%H,Minutes:%i,Seconds:%s");
        if (!$out_in_array)
            return $out;
        $a_out = array();
        array_walk(explode(',', $out), function($val, $key) use(&$a_out) {
                    $v = explode(':', $val);
                    $a_out[$v[0]] = $v[1];
                });
        return $a_out;
    }

    public static function pagination($link = '', $total = 0) {
        $html = '';
        if (!empty($link) || $total) {
            $html .= '<div class="pagination">';
            $html .= ' <div style="float:left;">' . $link . '</div>';
            if ($total)
                $html .= ' <div style="float:right;"> Total Record: ' . $total . '</div>';
            $html .= ' <div cl="cl">&nbsp;</div>';
            $html .= '</div>';
        }
        return $html;
    }

    public static function arrayToStyle($array = array()) {
        $style = '<style>';

        foreach ($array as $key => $value) {
            $style .= $key . '{';

            foreach ($value as $a => $b) {
                $style .= $a . ':' . $b . ';';
            }

            $style .= '}';
        }

        $style .= '</style>';
        return $style;
    }

    public static function years($start = 2003, $end = 2013) {
        $years = array();
        if ($start < $end) {
            for ($start; $start <= $end; $start++) {
                $years[$start] = $start;
            }
        } else if ($start > $end) {
            for ($start; $start <= $end; $start--) {
                $years[$start] = $start;
            }
        } else {
            $years[$start] = $start;
        }
        return $years;
    }

    public static function files($filename, $directory, $content) {
        $path = $directory . $filename;

        if (file_exists($path)) {
            unlink($path);
        }

        $file = fopen($path, 'a');
        fwrite($file, $content);
        fclose($file);
    }
    
    public static function meetingStatus($status) {
        $description = self::$meeting_status;
        $message = '';
        if (isset($description[$status]))
            $message = $description[$status];
        return $message;
    }
    
    public static function getMeetingStatus($index = array()) {
        $list = array();
        foreach ($index as $value) {
            $list[$value] = self::meetingStatus($value);
        }
        return $list;
    }
    
    public static function agendaStatus($status) {
        $description = self::$agenda_status;
        $message = '';
        if (isset($description[$status]))
            $message = $description[$status];
        return $message;
    }
}

?>
