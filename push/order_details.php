<?php
/**
 * Created by PhpStorm.
 * User: BASMALA
 * Date: 06/08/2018
 * Time: 06:02 م
 */
try {
    include '../include/config.php';
    include '../include/functions.php';
    mb_internal_encoding('UTF-8');
//---------------check if table exists if not create table......
    if (tableExists($conn, 'order_details') !== true)
    {
        $sql = "CREATE TABLE IF NOT EXISTS  `order_details` (
	`_id` INT(11) NOT NULL AUTO_INCREMENT,
	`invoice` INT(11) NOT NULL,
	`item` INT(11) NOT NULL,
	`price` DOUBLE(15,3) NOT NULL,
	`tax` DOUBLE(15,3) NOT NULL,
	`service` DOUBLE(15,3) NULL DEFAULT '0.000',
	`quantity` INT(11) NOT NULL,
	`discount` DOUBLE(15,3) NULL DEFAULT '0.000',
	`net_price` DOUBLE(15,3) NULL DEFAULT '0.000',
	`void` INT(3) NULL DEFAULT '0',
	`last_edit` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`user_code` VARCHAR(50) NOT NULL,
	PRIMARY KEY (`_id`),
	UNIQUE INDEX `invoice` (`invoice`),
	CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`invoice`) REFERENCES `orders` (`invoice`)
)
";

        // use exec() because no results are returned
        $conn->exec($sql);
        echo "تم انشاء الجدول بنجاح!";
    }

    // get data via GET and store it into variables.
    // Example    127.0.0.1/fooddelivery_menu/push/fooddelivery_menu.php?id=10&name=بيتزا
    $id = isset($_GET['_id']) && $_GET['_id'] !== '' ? Quoted($_GET['_id'])  : 'null';
    $invoice = isset($_GET['invoice']) && $_GET['invoice'] !== '' ? Quoted($_GET['invoice']) : 'null';
    $item = isset($_GET['item']) && $_GET['item'] !== '' ? Quoted($_GET['item'])  : 'null';
    $price = isset($_GET['price']) && $_GET['price'] !== '' ? Quoted($_GET['price']) : 'null';
    $tax = isset($_GET['tax']) && $_GET['tax'] !== '' ? Quoted($_GET['tax'])  : 'null';
    $service = isset($_GET['service']) && $_GET['service'] !== '' ? Quoted($_GET['service']) : 'null';
    $quantity = isset($_GET['quantity']) && $_GET['quantity'] !== '' ? Quoted($_GET['quantity'])  : 'null';
    $discount = isset($_GET['discount']) && $_GET['discount'] !== '' ? Quoted($_GET['discount']) : 'null';
    $net_price = isset($_GET['net_price']) && $_GET['net_price'] !== '' ? Quoted($_GET['net_price'])  : 'null';


    //---- Replace into to merge data if not exist insert new record if exists update record.
    $sql = "REPLACE INTO order_details (_id, invoice, item,price,tax,service,quantity, discount,net_price )
    VALUES ($id, $invoice, $item,$price,$tax,$service,$quantity,$discount,$net_price))";
    // use exec() because no results are returned
    // echo $sql;
    $conn->exec($sql);
    echo "تم اضافة صف جديد!";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
