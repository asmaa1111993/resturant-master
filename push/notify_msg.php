<?php
/**
 * Created by PhpStorm.
 * User: BASMALA
 * Date: 06/08/2018
 * Time: 05:57 م
 */
try {
    include '../include/config.php';
    include '../include/functions.php';
    mb_internal_encoding('UTF-8');
//---------------check if table exists if not create table......
    if (tableExists($conn, 'notify_msg') !== true)
    {
        $sql = "CREATE TABLE IF NOT EXISTS `notify_msg` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`message` TEXT NOT NULL,
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
    $message = isset($_GET['message']) && $_GET['message'] !== '' ? Quoted($_GET['message']) : 'null';


    //---- Replace into to merge data if not exist insert new record if exists update record.
    $sql = "REPLACE INTO notigy_msg (id,message )
    VALUES ($id, $message)";
    // use exec() because no results are returned
    // echo $sql;
    $conn->exec($sql);
    echo "تم اضافة صف جديد!";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
