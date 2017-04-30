<?php
    $_SERVER['SERVER_NAME'] = !isset($_SERVER['SERVER_NAME']) ? 'localhost' : $_SERVER['SERVER_NAME'];
    $local_servers = array('localhost');

    $is_local = in_array($_SERVER['SERVER_NAME'], $local_servers);
    $is_cli = php_sapi_name() === 'cli' ? TRUE : FALSE;

    $env = $is_local ? ($is_cli ? 'production' : 'development') : 'production';
    
    define('ENVIRONMENT', $env);
    define('EXT', '.php');
?>
