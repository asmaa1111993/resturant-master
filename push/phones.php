<?php
/**
 * Created by PhpStorm.
 * User: BASMALA
 * Date: 06/08/2018
 * Time: 06:30 م
 */
try {
    include '../include/config.php';
    include '../include/functions.php';
    mb_internal_encoding('UTF-8');
//---------------check if table exists if not create table......
    if (tableExists($conn, 'phones') !== true)
    {
        $sql = "CREATE TABLE IF NOT EXISTS `phones` (
	`_id` INT(11) NOT NULL AUTO_INCREMENT,
	`cust_id` VARCHAR(100) NOT NULL,
	`phone` VARCHAR(50) NOT NULL,
	`active` INT(3) NULL DEFAULT '0',
	`last_edit` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`user_code` VARCHAR(50) NOT NULL,
	`addTime` BIGINT(20) NOT NULL,
	PRIMARY KEY (`_id`),
	INDEX `addresses` (`cust_id`),
	CONSTRAINT `phones_ibfk_1` FOREIGN KEY (`cust_id`) REFERENCES `customer` (`code`)
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
    $phone = isset($_GET['phone']) && $_GET['phone'] !== '' ? Quoted($_GET['phone']) : 'null';


    //---- Replace into to merge data if not exist insert new record if exists update record.
    $sql = "REPLACE INTO phones (_id, cust_id, phone )
    VALUES ($id, $name,$phone)";
    // use exec() because no results are returned
    // echo $sql;
    $conn->exec($sql);
    echo "تم اضافة صف جديد!";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
