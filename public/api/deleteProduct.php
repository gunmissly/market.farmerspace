<?php
include_once "_connect.php";
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
date_default_timezone_set("Asia/Bangkok");

/*=================================
=            Condition            =
=================================*/
$UserType = substr($_GET['id'], 0,1);
if ($UserType == 'B') {
    $table = 'tb_buying';
} elseif ($UserType == 'S') {
    $table = 'tb_selling';
}
/*=====  End of Condition  ======*/

/*=================================
=      DELETE BUYER PRODUCT      =
=================================*/

    // delete data
    try {
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("DELETE FROM $table WHERE RequestID=:RequestID");

        // Go Update
        $stmt->execute(array(
            'RequestID'       => $_GET['id'],
        ));
        $res['message'] = "Deleted";
        echo json_encode($res, JSON_PRETTY_PRINT);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

/*=====  End of Condition  ======*/
