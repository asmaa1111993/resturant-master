<?php
/**
 * Created by PhpStorm.
 * User: BASMALA
 * Date: 06/08/2018
 * Time: 07:02 م
 */
try {
    include '../include/config.php';
    include '../include/functions.php';
    mb_internal_encoding('UTF-8');
//---------------check if table exists if not create table......
    if (tableExists($conn, 'tokendata') !== true)
    {
        $sql = "CREATE TABLE IF NOT EXISTS `tokendata` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`delivery_boyid` INT(11) NOT NULL,
	`user_id` INT(11) NOT NULL,
	`token` VARCHAR(255) NOT NULL,
	`type` VARCHAR(50) NOT NULL,
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
    $delivery_boyid = isset($_GET['delivery_boyid']) && $_GET['delivery_boyid'] !== '' ? Quoted($_GET['delivery_boyid']) : 'null';
    $user_id = isset($_GET['user_id']) && $_GET['user_id'] !== '' ? Quoted($_GET['user_id'])  : 'null';
    $token = isset($_GET['token']) && $_GET['token'] !== '' ? Quoted($_GET['token'])  : 'null';
    $type = isset($_GET['type']) && $_GET['type'] !== '' ? Quoted($_GET['type'])  : 'null';

    //---- Replace into to merge data if not exist insert new record if exists update record.
    $sql = "REPLACE INTO tokendata (id, delivery_boyid, user_id,token,type )
    VALUES ($id, $delivery_boyid,$user_id,$token,$type)";
    // use exec() because no results are returned
    // echo $sql;
    $conn->exec($sql);
    echo "تم اضافة صف جديد!";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
