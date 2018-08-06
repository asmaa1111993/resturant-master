<?php
/**
 * Created by PhpStorm.
 * User: BASMALA
 * Date: 06/08/2018
 * Time: 06:14 م
 */
try {
    include '../include/config.php';
    include '../include/functions.php';
    mb_internal_encoding('UTF-8');
//---------------check if table exists if not create table......
    if (tableExists($conn, 'payments') !== true)
    {
        $sql = "CREATE TABLE IF NOT EXISTS `payments` (
	`_id` INT(11) NOT NULL AUTO_INCREMENT,
	`invoice_no` INT(11) NOT NULL,
	`pay_type` VARCHAR(50) NOT NULL,
	`value` DOUBLE(15,3) NOT NULL,
	`cust_id` INT(11) NOT NULL,
	`shift_id` INT(11) NOT NULL,
	`shift_date` DATETIME NOT NULL,
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
    $invoice_no = isset($_GET['invoice_no']) && $_GET['invoice_no'] !== '' ? Quoted($_GET['invoice_no']) : 'null';
    $pay_type = isset($_GET['pay_type']) && $_GET['pay_type'] !== '' ? Quoted($_GET['pay_type']) : 'null';
    $value = isset($_GET['value']) && $_GET['value'] !== '' ? Quoted($_GET['value']) : 'null';
    $cust_id = isset($_GET['cust_id']) && $_GET['cust_id'] !== '' ? Quoted($_GET['cust_id']) : 'null';
    $shift_id = isset($_GET['shift_id']) && $_GET['shift_id'] !== '' ? Quoted($_GET['shift_id']) : 'null';
    $shift_date = isset($_GET['shift_date']) && $_GET['shift_date'] !== '' ? Quoted($_GET['shift_date']) : 'null';

    //---- Replace into to merge data if not exist insert new record if exists update record.
    $sql = "REPLACE INTO payments (_id, invoice_no, pay_type,value,cust_id,shift_id,shift_date )
    VALUES ($id, $invoice_no, $pay_type,$value,$cust_id,$shift_id,$shift_date)";
    // use exec() because no results are returned
    // echo $sql;
    $conn->exec($sql);
    echo "تم اضافة صف جديد!";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
