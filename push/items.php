<?php
/**
 * Created by PhpStorm.
 * User: BASMALA
 * Date: 06/08/2018
 * Time: 05:30 م
 */
try {
    include '../include/config.php';
    include '../include/functions.php';
    mb_internal_encoding('UTF-8');
//---------------check if table exists if not create table......
    if (tableExists($conn, 'items') !== true)
    {
        $sql = "CREATE TABLE IF NOT EXISTS `items` (
	`item_id` INT(11) NOT NULL AUTO_INCREMENT,
	`item_code` VARCHAR(50) NOT NULL,
	`menu_code` VARCHAR(50) NOT NULL,
	`arTitle` VARCHAR(100) NOT NULL,
	`engTitle` VARCHAR(100) NOT NULL,
	`price` DOUBLE(15,3) NOT NULL,
	`tax` DOUBLE(15,3) NOT NULL DEFAULT '0.000',
	`service` DOUBLE(15,3) NOT NULL DEFAULT '0.000',
	`image` TEXT NULL,
	`active` INT(2) NOT NULL DEFAULT '1',
	`Dduration` DOUBLE(15,3) NULL DEFAULT NULL,
	`last_edit` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`user_code` VARCHAR(50) NOT NULL,
	PRIMARY KEY (`item_id`),
	UNIQUE INDEX `item_code` (`item_code`),
	INDEX `items` (`menu_code`),
	CONSTRAINT `items_ibfk_1` FOREIGN KEY (`menu_code`) REFERENCES `menu` (`code`)
)
";

        // use exec() because no results are returned
        $conn->exec($sql);
        echo "تم انشاء الجدول بنجاح!";
    }

    // get data via GET and store it into variables.
    // Example    127.0.0.1/fooddelivery_menu/push/fooddelivery_menu.php?id=10&name=بيتزا
    $item_id = isset($_GET['item_id']) && $_GET['item_id'] !== '' ? Quoted($_GET['item_id'])  : 'null';
    $item_code = isset($_GET['item_code']) && $_GET['item_code'] !== '' ? Quoted($_GET['item_code']) : 'null';
    $menu_code = isset($_GET['menu_code']) && $_GET['menu_code'] !== '' ? Quoted($_GET['menu_code']) : 'null';
    $engTitle = isset($_GET['engTitle']) && $_GET['engTitle'] !== '' ? Quoted($_GET['engTitle']) : 'null';
    $price = isset($_GET['price']) && $_GET['price'] !== '' ? Quoted($_GET['price']) : 'null';
    $tax =  isset($_GET['tax']) && $_GET['tax'] !== '' ? Quoted($_GET['tax']) : 'null';
    $service =  isset($_GET['service']) && $_GET['service'] !== '' ? Quoted($_GET['service']) : 'null';
    //---- Replace into to merge data if not exist insert new record if exists update record.
    $sql = "REPLACE INTO items (item_id, item_code, menu_code,engTitle ,price,tax,service)
    VALUES ($item_id, $item_code,$menu_code,$engTitle,$price,$tax,$service)";
    // use exec() because no results are returned
    // echo $sql;
    $conn->exec($sql);
    echo "تم اضافة صف جديد!";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}