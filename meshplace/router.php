<?php

return array(
    /* Untuk mendeklarasikan folder application */
    'framework' => base_path . '/' . framework_base . '/main.php',
    'application' => array(
        'main' => array(
            'name' => 'Meshplace',
            'folder' => 'main',
            'themes' => 'orangestrip'
        ),
        'child' => array(
            array(
                'name' => 'Nilai Online',
                'alias' => 'nilaionline',
                'folder' => 'onlinescore',
                'themes' => 'orangestrip'
            )
        )
    )
);
?>
