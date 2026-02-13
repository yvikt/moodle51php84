<?php

unset($CFG);
global $CFG;
$CFG = new stdClass();

$CFG->dbtype    = 'mariadb';
$CFG->dblibrary = 'native';
$CFG->dbhost    = getenv('DB_HOST');
$CFG->dbname    = getenv('DB_NAME');
$CFG->dbuser    = getenv('DB_USER');
$CFG->dbpass    = getenv('DB_PASSWORD');
$CFG->prefix    = 'mdl_';
$CFG->dboptions = [
    'dbpersist' => false,
    'dbsocket'  => false,
    'dbport'    => '',
    'dbhandlesoptions' => false,
    'dbcollation' => 'utf8mb4_unicode_ci',
];

$CFG->wwwroot   = getenv('WWW_ROOT');
$CFG->dataroot  = '/var/www/moodledata';
$CFG->routerconfigured = false;
$CFG->directorypermissions = 02777;
$CFG->admin = 'admin';

$CFG->xsendfile = 'X-Accel-Redirect';
$CFG->xsendfilealiases = array(
     '/dataroot/' => $CFG->dataroot,
);

$CFG->session_handler_class = '\core\session\redis';
$CFG->session_redis_host = 'redis';
$CFG->session_redis_port = 6379;
$CFG->session_redis_database = 0;

require_once(__DIR__ . '/lib/setup.php'); // Do not edit
