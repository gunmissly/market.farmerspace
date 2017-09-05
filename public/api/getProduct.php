<?php
include_once "_connect.php";
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
date_default_timezone_set("Asia/Bangkok");

/*=================================
=      Condition set sql query    =
=================================*/
$UserType = $_GET['UserType'];

if ($UserType == 'buyer') {
    $sql = 'SELECT * FROM tb_buying';
} elseif ($UserType == 'farmer') {
    $sql = 'SELECT * FROM tb_selling';
}

/*=====  End of Condition  ======*/

switch ($UserType) {
    case 'buyer':
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_OBJ);

            echo json_encode($result, JSON_PRETTY_PRINT);

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        break;
    case 'farmer':
        try {
            $stmt = $conn->prepare($sql);
            $stmt->execute();

            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            echo json_encode($result, JSON_PRETTY_PRINT);

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
        break;
    default:
        # code...
        break;
}
