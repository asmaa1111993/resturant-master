<?php
/**
 * Created by PhpStorm.
 * User: BASMALA
 * Date: 06/08/2018
 * Time: 04:21 م
 */
try {
    include '../include/config.php';
    include '../include/functions.php';
    mb_internal_encoding('UTF-8');
//---------------check if table exists if not create table......
    if (tableExists($conn, 'addresses') !== true)
    {
        $sql = "CREATE TABLE IF NOT EXISTS `addresses` (
	`_id` INT(11) NOT NULL AUTO_INCREMENT,
	`cust_id` VARCHAR(100) NOT NULL,
	`address` VARCHAR(255) NOT NULL,
	`active` INT(3) NULL DEFAULT '0',
	`last_edit` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`user_code` VARCHAR(50) NOT NULL,
	`addTime` BIGINT(20) NOT NULL,
	PRIMARY KEY (`_id`),
	INDEX `addresses` (`cust_id`),
	CONSTRAINT `addresses_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`code`)
)
";

        // use exec() because no results are returned
        $conn->exec($sql);
        echo "تم انشاء الجدول بنجاح!";
    }

    // get data via GET and store it into variables.
    // Example    127.0.0.1/fooddelivery_menu/push/fooddelivery_menu.php?id=10&name=بيتزا
    $id = isset($_GET['_id']) && $_GET['_id'] !== '' ? Quoted($_GET['_id'])  : 'null';
    $cust_id = isset($_GET['cust_id']) && $_GET['cust_id'] !== '' ? Quoted($_GET['cust_id']) : 'null';
    $address = isset($_GET['address']) && $_GET['address'] !== '' ? Quoted($_GET['address']) : 'null';


    //---- Replace into to merge data if not exist insert new record if exists update record.
    $sql = "REPLACE INTO addresses(_id, engTitle, address )
    VALUES ($id, $cust_id, $address))";
    // use exec() because no results are returned
    // echo $sql;
    $conn->exec($sql);
    echo "تم اضافة صف جديد!";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
