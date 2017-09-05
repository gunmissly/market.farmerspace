<?php
include_once "_connect.php";
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
date_default_timezone_set("Asia/Bangkok");

/*=================================
=            Condition            =
=================================*/
$UserType = $_POST['UserType'];

if ($UserType == 'buyer') {
    $table = 'tb_buying';
    // check ID
    try {
        $stmt = $conn->prepare("SELECT Max(substr(RequestID,-6))+1 AS MaxID FROM $table");
        $stmt->execute();

        $result = $stmt->fetchAll();
        if ($result[0]['MaxID'] == '') {
            $RequestID = "B000001";
        } else {
            $RequestID = "B" . sprintf("%06d", $result[0]['MaxID']);
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} elseif ($UserType == 'farmer') {
    $table = 'tb_selling';
    // check ID
    try {
        $stmt = $conn->prepare("SELECT Max(substr(RequestID,-6))+1 AS MaxID FROM $table");
        $stmt->execute();

        $result = $stmt->fetchAll();
        if ($result[0]['MaxID'] == '') {
            $RequestID = "S000001";
        } else {
            $RequestID = "S" . sprintf("%06d", $result[0]['MaxID']);
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
/*=====  End of Condition  ======*/

/*=================================
=      INSERT BUYER PRODUCT      =
=================================*/

    

    // insert data
    try {
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("INSERT INTO $table (RequestID,UserID,ProductName,Species,Detail,Price,Quantity,HarvestDay,Address,SubDistrict,District,Province,Zipcode,Latitude,Longitude,AcceptCondition,CreateDate)
                        VALUES (:RequestID,:UserID,:ProductName,:Species,:Detail,:Price,:Quantity,:HarvestDay,:Address,:SubDistrict,:District,:Province,:Zipcode,:Latitude,:Longitude,:AcceptCondition,:CreateDate)");

        // Go Insert
        $stmt->execute(array(
            'RequestID'       => $RequestID,
            'UserID'          => $_POST['UserID'],
            'ProductName'     => $_POST['ProductName'],
            'Species'         => $_POST['Species'],
            'Detail'          => $_POST['Detail'],
            'Price'           => $_POST['Price'],
            'Quantity'        => $_POST['Quantity'],
            'HarvestDay'      => $_POST['HarvestDay'],
            'Address'         => $_POST['Address'],
            'SubDistrict'     => $_POST['SubDistrict'],
            'District'        => $_POST['District'],
            'Province'        => $_POST['Province'],
            'Zipcode'         => $_POST['Zipcode'],
            'Latitude'        => $_POST['Latitude'],
            'Longitude'       => $_POST['Longitude'],
            'AcceptCondition' => true,
            'CreateDate'      => date("Y-m-d H:i:s"),
        ));
        $res['message'] = "Insert";
        echo json_encode($res, JSON_PRETTY_PRINT);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

/*=====  End of Condition  ======*/
