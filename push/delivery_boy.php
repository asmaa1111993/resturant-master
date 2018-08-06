<?php
/**
 * Created by PhpStorm.
 * User: BASMALA
 * Date: 06/08/2018
 * Time: 05:12 م
 */
try {
    include '../include/config.php';
    include '../include/functions.php';
    mb_internal_encoding('UTF-8');
//---------------check if table exists if not create table......
    if (tableExists($conn, 'delivery_boy') !== true)
    {
        $sql = "CREATE TABLE IF NOT EXISTS `delivery_boy`(
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(100) NOT NULL,
	`phone` VARCHAR(20) NOT NULL,
	`email` VARCHAR(100) NOT NULL,
	`password` VARCHAR(55) NOT NULL,
	`vehicle_no` VARCHAR(32) NOT NULL,
	`vehicle_type` VARCHAR(25) NOT NULL,
	`lat` INT(55) NOT NULL,
	`long` INT(55) NOT NULL,
	`attendance` VARCHAR(8) NOT NULL,
	`created_at` INT(11) NOT NULL,
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
    $name = isset($_GET['name']) && $_GET['name'] !== '' ? Quoted($_GET['name']) : 'null';
    $phone = isset($_GET['phone']) && $_GET['phone'] !== '' ? Quoted($_GET['phone']) : 'null';
    $email = isset($_GET['email']) && $_GET['email'] !== '' ? Quoted($_GET['email']) : 'null';
    $password =isset($_GET['password']) && $_GET['password'] !== '' ? Quoted($_GET['password']) : 'null';
    $vehicle_no = isset($_GET['vehicle_no']) && $_GET['vehicle_no'] !== '' ? Quoted($_GET['vehicle_no']) : 'null';
    $vehicle_type = isset($_GET['vehicle_type']) && $_GET['vehicle_type'] !== '' ? Quoted($_GET['vehicle_type']) : 'null';
    //---- Replace into to merge data if not exist insert new record if exists update record.
    $sql = "REPLACE INTO delivery_boy(id, name, phone,email,password,vehicle_no, vehicle_type)
    VALUES ($id, $name, $phone, $email, $password ,$vehicle_no,$vehicle_type)";
    // use exec() because no results are returned
    // echo $sql;
    $conn->exec($sql);
    echo "تم اضافة صف جديد!";

}
catch(PDOException $e)
{
    echo $sql . "<br>" . $e->getMessage();
}