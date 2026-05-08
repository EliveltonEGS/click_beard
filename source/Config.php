<?php

$request = $_SERVER["REQUEST_SCHEME"]; //http
$server_name = $_SERVER["SERVER_NAME"]; //localhost
$script_name = explode("/", $_SERVER["SCRIPT_NAME"]); //ClickBeard_elivelton_goncalves

/** BASE URL */
define("ROOT", "http://localhost:8060");

/** DATABASE CONNECT */;
define("DB_CONFIG", [
    "driver" => "mysql",
    "host" => "mysql",
    "port" => "3306",
    "dbname" => "click_beard",
    "username" => "root",
    "passwd" => "root"
]);

function url(string $path): string
{
    if ($path) {
        return ROOT . "{$path}";
    }
    return ROOT;
}

function dd($data)
{
    d($data);
}

function debug($data)
{
    echo "<pre>" . print_r($data, true) . "</pre>";
}

function writeLog($value, $logName)
{
    error_log(print_r($value, true) . PHP_EOL, 3, "C:/xampp/htdocs/ClickBeard_elivelton_goncalves/log/{$logName}.log");
}
