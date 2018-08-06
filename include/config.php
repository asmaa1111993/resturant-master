<?php
/**
 * User: sayyid
 * Date: 19/07/2018
 * Time: 01:57 م
 */
$servername = "127.0.0.1";   ///    ايبي السيرفر
$username = "asmaa";   ///   User Name
$password = "bondo2tymiromedeveloperasmaa";  // Password
$dbname = "restaurant";  // Database name


///   Connect to database and save connection data into object.
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password,
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    die("خطأ في الاتصال بقاعدة البيانات");
}
