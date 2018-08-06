<?php
/**
 * Created by PhpStorm.
 * User: BASMALA
 * Date: 06/08/2018
 * Time: 07:09 م
 */
try {
    include '../include/config.php';
    include '../include/functions.php';
    mb_internal_encoding('UTF-8');
//---------------check if table exists if not create table......
    if (tableExists($conn, 'users') !== true)
    {
        $sql = "CREATE TABLE IF NOT EXISTS  `users` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`uname` VARCHAR(30) NULL DEFAULT NULL,
	`upass` VARCHAR(50) NULL DEFAULT NULL,
	`fullname` VARCHAR(100) NULL DEFAULT NULL,
	`uemail` VARCHAR(70) NULL DEFAULT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `uname` (`uname`),
	UNIQUE INDEX `uemail` (`uemail`)
)
";

        // use exec() because no results are returned
        $conn->exec($sql);
        echo "تم انشاء الجدول بنجاح!";
    }

    // get data via GET and store it into variables.
    // Example    127.0.0.1/fooddelivery_menu/push/fooddelivery_menu.php?id=10&name=بيتزا
    $id = isset($_GET['menu_id']) && $_GET['menu_id'] !== '' ? Quoted($_GET['menu_id'])  : 'null';
    $name = isset($_GET['uname']) && $_GET['uname'] !== '' ? Quoted($_GET['uname']) : 'null';
    $upass = isset($_GET['upass']) && $_GET['upass'] !== '' ? Quoted($_GET['upass']) : 'null';
    $fullname =  isset($_GET['fullname']) && $_GET['fullname'] !== '' ? Quoted($_GET['fullname']) : 'null';
    $uemail = isset($_GET['uemail']) && $_GET['uemail'] !== '' ? Quoted($_GET['uemail']) : 'null';


    //---- Replace into to merge data if not exist insert new record if exists update record.
    $sql = "REPLACE INTO users (id, uname, upass,fullname,uemail )
    VALUES ($id, $name,$upass,$fullname,$uemail)";
    // use exec() because no results are returned
    // echo $sql;
    $conn->exec($sql);
    echo "تم اضافة صف جديد!";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
