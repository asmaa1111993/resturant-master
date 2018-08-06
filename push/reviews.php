<?php
/**
 * Created by PhpStorm.
 * User: BASMALA
 * Date: 06/08/2018
 * Time: 06:53 م
 */
try {
    include '../include/config.php';
    include '../include/functions.php';
    mb_internal_encoding('UTF-8');
//---------------check if table exists if not create table......
    if (tableExists($conn, 'reviews') !== true)
    {
        $sql = "CREATE TABLE IF NOT EXISTS  `reviews` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`user_id` INT(11) NOT NULL,
	`review_text` TEXT NOT NULL,
	`ratting` VARCHAR(10) NOT NULL,
	`created_at` INT(11) NOT NULL,
	`notify` TINYINT(1) NOT NULL,
	PRIMARY KEY (`id`)
)
";

        // use exec() because no results are returned
        $conn->exec($sql);
        echo "تم انشاء الجدول بنجاح!";
    }

    // get data via GET and store it into variables.
    // Example    127.0.0.1/fooddelivery_menu/push/fooddelivery_menu.php?id=10&name=بيتزا
    $id = isset($_GET['menu_id']) && $_GET['menu_id'] !== '' ? Quoted($_GET['menu_id'])  : 'null';
    $user_id = isset($_GET['user_id']) && $_GET['user_id'] !== '' ? Quoted($_GET['user_id']) : 'null';
    $review_text= isset($_GET['review_text']) && $_GET['review_text'] !== '' ? Quoted($_GET['review_text']) : 'null';
    $ratting = isset($_GET['ratting']) && $_GET['ratting'] !== '' ? Quoted($_GET['ratting']) : 'null';
    $created_at = isset($_GET['created_at']) && $_GET['created_at'] !== '' ? Quoted($_GET['created_at']) : 'null';
    $notify = isset($_GET['notify']) && $_GET['notify'] !== '' ? Quoted($_GET['notify']) : 'null';

    //---- Replace into to merge data if not exist insert new record if exists update record.
    $sql = "REPLACE INTO reviews(id, user_id,review_text,ratting, created_at ,notify)
    VALUES ($id, $user_id,$review_text,$ratting, unix_timestamp(UTC_TIMESTAMP),$notify)";
    // use exec() because no results are returned
    // echo $sql;
    $conn->exec($sql);
    echo "تم اضافة صف جديد!";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}
