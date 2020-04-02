<?php
header("Access-Control-Allow-Origin: *");
date_default_timezone_set("Asia/Bangkok");

error_reporting(E_ALL);
ini_set('display_errors', 1);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WisniorWeb */
define( 'DB_NAME', 'ictcluster' );
define( 'DB_USER', 'root' );
define( 'DB_PASSWORD', 'mandymorenn' );
define( 'DB_HOST', 'localhost' );
define( 'ROOT_DOMAIN', 'http://localhost/ictcluster/' );


$host = DB_HOST;
$user = DB_USER;
$password = DB_PASSWORD;
$dbname = DB_NAME;

$conn = mysqli_connect($host, $user, $password, $dbname);
if(!$conn){
  echo "Can not connect database";
  die();
}

$conn->set_charset("utf8");

// Define system parameters
$sysdate = date('Y-m-d');
$sysdatetime = date('Y-m-d H:i:s');
$sysdateu = date('U');
$sysdateyear = date('Y');
$ip = $_SERVER['REMOTE_ADDR'];
?>
