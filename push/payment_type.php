<?php
/**
 * Created by PhpStorm.
 * User: BASMALA
 * Date: 06/08/2018
 * Time: 06:26 م
 */
try {
    include '../include/config.php';
    include '../include/functions.php';
    mb_internal_encoding('UTF-8');
//---------------check if table exists if not create table......
    if (tableExists($conn, 'payment_type') !== true)
    {
        $sql = "CREATE TABLE IF NOT EXISTS `payment_type` (
	`_id` INT(11) NOT NULL AUTO_INCREMENT,
	`arTitle` VARCHAR(100) NOT NULL,
	`engTitle` VARCHAR(100) NOT NULL,
	`pay_type` VARCHAR(50) NOT NULL,
	`active` INT(3) NULL DEFAULT '0',
	`last_edit` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`user_code` VARCHAR(50) NOT NULL,
	`addTime` BIGINT(20) NOT NULL,
	PRIMARY KEY (`_id`)
)
";

        // use exec() because no results are returned
        $conn->exec($sql);
        echo "تم انشاء الجدول بنجاح!";
    }

    // get data via GET and store it into variables.
    // Example    127.0.0.1/fooddelivery_menu/push/fooddelivery_menu.php?id=10&name=بيتزا
    $id = isset($_GET['_id']) && $_GET['_id'] !== '' ? Quoted($_GET['_id'])  : 'null';
    $name = isset($_GET['engTitle']) && $_GET['engTitle'] !== '' ? Quoted($_GET['engTitle']) : 'null';
    $pay_type = isset($_GET['pay_type']) && $_GET['pay_type'] !== '' ? Quoted($_GET['pay_type']) : 'null';

    //---- Replace into to merge data if not exist insert new record if exists update record.
    $sql = "REPLACE INTO payment_type (_id, engTitle, pay_type )
    VALUES ($id, $name,$pay_type)";
    // use exec() because no results are returned
    // echo $sql;
    $conn->exec($sql);
    echo "تم اضافة صف جديد!";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
