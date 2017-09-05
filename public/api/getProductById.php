<?php
include_once "_connect.php";
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
date_default_timezone_set("Asia/Bangkok");

if (empty($_GET['id']) || is_null($_GET['id'])) {
    $result = 'invalid products id';
    echo json_encode($result, JSON_PRETTY_PRINT);
} else {
    /*=================================
    =      Condition set sql query    =
    =================================*/
    $id       = $_GET['id'];
    $UserType = $_GET['UserType'];
    /*=====  End of Condition  ======*/

    switch ($UserType) {
        case 'buyer':

            $sql = 'SELECT * FROM tb_buying WHERE RequestID = "' . $id . '"';

            try {
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_OBJ);

                if ($result) {
                    echo json_encode($result, JSON_PRETTY_PRINT);
                } else {
                    echo json_encode('Record Not found', JSON_PRETTY_PRINT);
                }

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            break;
        case 'farmer':

            $sql = 'SELECT * FROM tb_selling WHERE RequestID = "' . $id . '"';

            try {
                $stmt = $conn->prepare($sql);
                $stmt->execute();

                $result = $stmt->fetchAll(PDO::FETCH_OBJ);

                if ($result) {
                    echo json_encode($result, JSON_PRETTY_PRINT);
                } else {
                    echo json_encode('Record Not found', JSON_PRETTY_PRINT);
                }

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            break;
        default:
            # code...
            break;
    }
}

/*=====  End of Condition  ======*/
