<?php
/**
 * User: sayyid
 * Date: 30/07/2018
 * Time: 01:47 م
 */
try {
    include '../include/config.php';
    include '../include/functions.php';
    mb_internal_encoding('UTF-8');
//---------------check if table exists if not create table......
    if (tableExists($conn, 'menu') !== true)
    {
        $sql = "CREATE TABLE IF NOT EXISTS `menu` (
	`menu_id` INT(11) NOT NULL AUTO_INCREMENT,
	`code` VARCHAR(50) NOT NULL,
	`control` VARCHAR(50) NULL DEFAULT NULL,
	`arTitle` VARCHAR(100) NOT NULL,
	`engTitle` VARCHAR(100) NOT NULL,
	`image` TEXT NOT NULL,
	`active` INT(2) NOT NULL DEFAULT '1',
	`last_edit` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`user_code` VARCHAR(50) NOT NULL,
	`Created_at` INT(11) NOT NULL,
	PRIMARY KEY (`menu_id`),
	UNIQUE INDEX `code` (`code`)
)
";

        // use exec() because no results are returned
        $conn->exec($sql);
        echo "تم انشاء الجدول بنجاح!";
    }

    // get data via GET and store it into variables.
    // Example    127.0.0.1/fooddelivery_menu/push/fooddelivery_menu.php?id=10&name=بيتزا
    $id = isset($_GET['menu_id']) && $_GET['menu_id'] !== '' ? Quoted($_GET['menu_id'])  : 'null';
    $name = isset($_GET['engTitle']) && $_GET['engTitle'] !== '' ? Quoted($_GET['engTitle']) : 'null';


    //---- Replace into to merge data if not exist insert new record if exists update record.
    $sql = "REPLACE INTO fooddelivery_menu (_id, engTitle, created_at )
    VALUES ($id, $name, unix_timestamp(UTC_TIMESTAMP))";
    // use exec() because no results are returned
    // echo $sql;
    $conn->exec($sql);
    echo "تم اضافة صف جديد!";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
