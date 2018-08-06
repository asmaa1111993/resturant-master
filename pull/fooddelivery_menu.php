<?php
/**
 * User: sayyid
 * Date: 19/07/2018
 * Time: 02:16 م
 */
include '../include/config.php';  ///    -- data base connection data.
mb_internal_encoding('UTF-8');


// Query database for row exist or not     جملة الاستعلام
$sql = 'SELECT menu_id as menu_id , engTitle as engTitle, created_at as created_at
            FROM menu ;';
//  execute query
$stmt = $conn->prepare($sql);
$stmt->execute();

if ($stmt->rowCount()) {
    ob_start('ob_gzhandler');   // -- -to compress data
    $output = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $json = json_encode($output , true); // encode output to json format.
       $json = gzencode(trim(preg_replace('/\s+/',' ',$json )),9);
       header('Content-Encoding: gzip');
       header("content-type: application/json; charset=\"UTF-8");
       header("cache-control: must-revalidate");
       header("expires: ".gmdate("D, d M Y H:i:s",time()+60)." GMT" );
       header('Content-Length: ' . strlen( $json ) );
       header('Vary: Accept-Encoding');
       header("Access-Control-Allow-Origin: *");//this allows coors
    echo $json;  // parse json data
    ob_end_flush();//--- to free compress obj from server memory.
}

