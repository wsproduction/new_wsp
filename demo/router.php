<?php

return array(
    /* Untuk mendeklarasikan folder application */
    'framework' => base_path . '/' . framework_base . '/main.php',
    'application' => array(
        'main' => array(
            'name' => 'Web Default',
            'folder' => 'default',
            'themes' => 'default'
        ),
        'child' => array(
            array(
                'name' => 'Administrator',
                'alias' => 'admin',
                'folder' => 'admin',
                'themes' => 'default'
            )
        )
    )
);
?>
