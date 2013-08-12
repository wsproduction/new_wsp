<?php
return array(
    'active_db' => 'default', // Jika tidak akan menggunkanan database, active_db dikosongkan atau false
    'db' => array(
        'default' => array(
            'dbdriver' => 'mysql',
            'hostname' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'dbac_meshplace'
        ),
        'onlinescore' => array(
            'dbdriver' => 'mysql',
            'hostname' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'dbac_onlinescore'
        )
    )
);
?>
