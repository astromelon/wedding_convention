<?php
/**
 * Created by PhpStorm.
 * User: astromelon
 * Date: 2017-01-03
 * Time: 오후 2:44
 */

header("Content-Type:text/html;charset=utf-8");

// sentry
require_once '../sentry-php-master/lib/Raven/Autoloader.php';
Raven_Autoloader::register();
$client = new Raven_Client('https://7a26e920ebac44ea8035c4e6124d6bc7:377ae1efcc0c4dd78beb07186cc608e2@sentry.io/121423');
$error_handler = new Raven_ErrorHandler($client);
$error_handler->registerExceptionHandler();
$error_handler->registerErrorHandler();
$error_handler->registerShutdownFunction();


// DB접속
$host = "localhost";
$user = "ssongu";
$password = "ssongu52mysql";
$dbname = "ssongu";
$link = mysqli_connect($host, $user, $password, $dbname);
if(!$link){
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit();
}

// json 한글 인코딩
// mysqli_query($link, "SET NAMES 'utf8'");
mysqli_set_charset($link, "utf8");