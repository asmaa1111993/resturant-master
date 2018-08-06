<?php
/**
 * Created by PhpStorm.
 * User: BASMALA
 * Date: 06/08/2018
 * Time: 04:52 م
 */
try {
    include '../include/config.php';
    include '../include/functions.php';
    mb_internal_encoding('UTF-8');
//---------------check if table exists if not create table......
    if (tableExists($conn, 'bookorder') !== true)
    {
        $sql = "CREATE TABLE IF NOT EXISTS `bookorder` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL,
	`address` VARCHAR(200) NOT NULL,
	`lat` VARCHAR(100) NOT NULL,
	`longOrder` VARCHAR(100) NOT NULL,
	`notes` TEXT NOT NULL,
	`total_price` VARCHAR(10) NOT NULL,
	`payment` VARCHAR(52) NOT NULL,
	`created_at` VARCHAR(15) NOT NULL,
	`notify` TINYINT(1) NOT NULL,
	`statues` INT(11) NOT NULL,
	`accept_date_time` VARCHAR(50) NOT NULL,
	`accept_status` VARCHAR(6) NOT NULL,
	`assign_date_time` VARCHAR(153) NOT NULL,
	`assign_status` VARCHAR(17) NOT NULL,
	`delivered_date_time` VARCHAR(50) NOT NULL,
	`delivery_date_time` VARCHAR(50) NOT NULL,
	`delivery_status` VARCHAR(6) NOT NULL,
	`delivered_status` VARCHAR(6) NOT NULL,
	`is_assigned` VARCHAR(112) NOT NULL,
	PRIMARY KEY (`id`)
)
";

        // use exec() because no results are returned
        $conn->exec($sql);
        echo "تم انشاء الجدول بنجاح!";
    }

    // get data via GET and store it into variables.
    // Example    127.0.0.1/fooddelivery_menu/push/fooddelivery_menu.php?id=10&name=بيتزا
    $id = isset($_GET['menu_id']) && $_GET['menu_id'] !== '' ? Quoted($_GET['menu_id'])  : 'null';
    $user_id  = isset($_GET['user_id']) && $_GET['user_id'] !== '' ? Quoted($_GET['user_id']) : 'null';
    $address = isset($_GET['address']) && $_GET['address'] !== '' ? Quoted($_GET['address']) : 'null';
    $total_price = isset($_GET['total_price']) && $_GET['total_price'] !== '' ? Quoted($_GET['total_price']) : 'null';
    $payment = isset($_GET['payment']) && $_GET['payment'] !== '' ? Quoted($_GET['payment']) : 'null';


    //---- Replace into to merge data if not exist insert new record if exists update record.
    $sql = "REPLACE INTO bookorder(_id, engTitle, created_at )
    VALUES ($id, $user_id, $address,$total_price,$payment))";
    // use exec() because no results are returned
    // echo $sql;
    $conn->exec($sql);
    echo "تم اضافة صف جديد!";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}