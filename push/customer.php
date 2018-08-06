<?php
/**
 * Created by PhpStorm.
 * User: BASMALA
 * Date: 06/08/2018
 * Time: 05:02 م
 */
try {
    include '../include/config.php';
    include '../include/functions.php';
    mb_internal_encoding('UTF-8');
//---------------check if table exists if not create table......
    if (tableExists($conn, 'customer') !== true)
    {
        $sql = "CREATE TABLE IF NOT EXISTS `customer` (
	`_id` INT(11) NOT NULL AUTO_INCREMENT,
	`code` VARCHAR(100) NOT NULL,
	`birth_date` DATETIME NOT NULL,
	`spose_name` VARCHAR(100) NOT NULL,
	`spose_birthDate` DATETIME NOT NULL,
	`last_edit` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`user_code` VARCHAR(50) NOT NULL,
	`addTime` BIGINT(20) NOT NULL,
	PRIMARY KEY (`_id`),
	UNIQUE INDEX `code` (`code`)
)
";

        // use exec() because no results are returned
        $conn->exec($sql);
        echo "تم انشاء الجدول بنجاح!";
    }

    // get data via GET and store it into variables.
    // Example    127.0.0.1/fooddelivery_menu/push/fooddelivery_menu.php?id=10&name=بيتزا
    $id = isset($_GET['_id']) && $_GET['_id'] !== '' ? Quoted($_GET['_id'])  : 'null';
    $code = isset($_GET['code']) && $_GET['code'] !== '' ? Quoted($_GET['code'])  : 'null';
    $birth_date =isset($_GET['birth_date']) && $_GET['birth_date'] !== '' ? Quoted($_GET['birth_date'])  : 'null';
    $spose_name = isset($_GET['spose_name']) && $_GET['spose_name'] !== '' ? Quoted($_GET['spose_name']) : 'null';
    $spose_birthDate =isset($_GET['spose_birthDate']) && $_GET['spose_birthDate'] !== '' ? Quoted($_GET['spose_birthDate']) : 'null';


    //---- Replace into to merge data if not exist insert new record if exists update record.
    $sql = "REPLACE INTO customer (_id,code, birth_date,spose_name,spose_birthDate )
    VALUES ($id, $code, $birth_date,$spose_name,$spose_birthDate))";
    // use exec() because no results are returned
    // echo $sql;
    $conn->exec($sql);
    echo "تم اضافة صف جديد!";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}