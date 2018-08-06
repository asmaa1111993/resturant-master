<?php
/**
 * Created by PhpStorm.
 * User: BASMALA
 * Date: 06/08/2018
 * Time: 04:30 م
 */
try {
    include '../include/config.php';
    include '../include/functions.php';
    mb_internal_encoding('UTF-8');
//---------------check if table exists if not create table......
    if (tableExists($conn, 'adminLogin') !== true)
    {
        $sql = "CREATE TABLE IF NOT EXISTS `adminlogin` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`fullname` VARCHAR(30) NOT NULL,
	`username` VARCHAR(100) NOT NULL,
	`userPassword` VARCHAR(50) NOT NULL,
	`email` VARCHAR(120) NOT NULL,
	`role` VARCHAR(11) NOT NULL,
	`icon` VARCHAR(100) NOT NULL,
	`is_delete` TINYINT(1) NOT NULL,
	PRIMARY KEY (`id`)
)
";

        // use exec() because no results are returned
        $conn->exec($sql);
        echo "تم انشاء الجدول بنجاح!";
    }

    // get data via GET and store it into variables.
    // Example    127.0.0.1/fooddelivery_menu/push/fooddelivery_menu.php?id=10&name=بيتزا
    $id = isset($_GET['id']) && $_GET['id'] !== '' ? Quoted($_GET['id'])  : 'null';
    $name = isset($_GET[' username']) && $_GET[' username'] !== '' ? Quoted($_GET[' username']) : 'null';
    $userPassword = isset($_GET['userPassword']) && $_GET['userPassword'] !== '' ? Quoted($_GET['userPassword']) : 'null';
    //---- Replace into to merge data if not exist insert new record if exists update record.
    $sql = "REPLACE INTO adminLogin (id, username,userPassword )
    VALUES ($id, $name,$userPassword))";
    // use exec() because no results are returned
    // echo $sql;
    $conn->exec($sql);
    echo "تم اضافة صف جديد!";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
