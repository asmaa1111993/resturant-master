<?php
/**
 * Created by PhpStorm.
 * User: BASMALA
 * Date: 06/08/2018
 * Time: 06:35 م
 */
try {
    include '../include/config.php';
    include '../include/functions.php';
    mb_internal_encoding('UTF-8');
//---------------check if table exists if not create table......
    if (tableExists($conn, 'restaurant') !== true)
    {
        $sql = "CREATE TABLE IF NOT EXISTS `restaurant` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(200) NOT NULL,
	`address` VARCHAR(500) NOT NULL,
	`open_time` VARCHAR(30) NOT NULL,
	`close_time` VARCHAR(30) NOT NULL,
	`delivery_time` VARCHAR(30) NOT NULL,
	`timestamp` VARCHAR(20) NOT NULL,
	`currency` VARCHAR(10) NOT NULL,
	`photo` VARCHAR(100) NOT NULL,
	`phone` VARCHAR(15) NOT NULL,
	`lat` VARCHAR(30) NOT NULL,
	`lon` VARCHAR(30) NOT NULL,
	`desc` TEXT NOT NULL,
	`email` VARCHAR(100) NOT NULL,
	`website` VARCHAR(200) NOT NULL,
	`city` VARCHAR(50) NOT NULL,
	`location` VARCHAR(300) NOT NULL,
	`is_active` TINYINT(1) NOT NULL,
	`del_charge` VARCHAR(50) NOT NULL,
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
    $name = isset($_GET['name']) && $_GET['name'] !== '' ? Quoted($_GET['name']) : 'null';
    $address = isset($_GET['address']) && $_GET['address'] !== '' ? Quoted($_GET['address'])  : 'null';
    $open_time = isset($_GET['open_time']) && $_GET['open_time'] !== '' ? Quoted($_GET['open_time']) : 'null';
    $close_time = isset($_GET['close_time']) && $_GET['close_time'] !== '' ? Quoted($_GET['close_time'])  : 'null';
    $delivery_time = isset($_GET['delivery_time']) && $_GET['delivery_time'] !== '' ? Quoted($_GET['delivery_time']) : 'null';
    $timestamp = isset($_GET['menu_id']) && $_GET['menu_id'] !== '' ? Quoted($_GET['menu_id'])  : 'null';
    $currency = isset($_GET['currency']) && $_GET['currency'] !== '' ? Quoted($_GET['currency']) : 'null';
    $photo = isset($_GET['photo']) && $_GET['photo'] !== '' ? Quoted($_GET['photo'])  : 'null';
    $phone = isset($_GET['phone']) && $_GET['phone'] !== '' ? Quoted($_GET['phone']) : 'null';


    //---- Replace into to merge data if not exist insert new record if exists update record.
    $sql = "REPLACE INTO restaurant (id, name, address,open_time,close_time,delivery_time,timestamp,currency,photo,phone )
    VALUES ($id, $name, $address,$open_time,$close_time,$delivery_time,unix_timestamp(UTC_TIMESTAMP),$currency,$photo,,$phone)";
    // use exec() because no results are returned
    // echo $sql;
    $conn->exec($sql);
    echo "تم اضافة صف جديد!";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
