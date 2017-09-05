<?php
include_once "_connect.php";
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
date_default_timezone_set("Asia/Bangkok");

/*=================================
=            Condition            =
=================================*/
if ($_POST['UserType'] == 'buyer') {
    $table = 'tb_buying';
} elseif ($_POST['UserType'] == 'farmer') {
    $table = 'tb_selling';
}
/*=====  End of Condition  ======*/

/*=================================
=      UPDATE BUYER PRODUCT      =
=================================*/
echo $_POST['RequestID'];
echo $_POST['UserID'];
echo $_POST['ProductName'];
echo $_POST['Species'];
echo $_POST['Detail'];
echo $_POST['Price'];
echo $_POST['Quantity'];
echo $_POST['HarvestDay'];
echo $_POST['Address'];
echo $_POST['SubDistrict'];
echo $_POST['District'];
echo $_POST['Province'];
echo $_POST['Zipcode'];
echo $_POST['Latitude'];
echo $_POST['Longitude'];

    // update data
    try {
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn->prepare("UPDATE $table SET UserID=:UserID,ProductName=:ProductName,Species=:Species,Detail=:Detail,Price=:Price,Quantity=:Quantity,HarvestDay=:HarvestDay,Address=:Address,SubDistrict=:SubDistrict,District=:District,Province=:Province,Zipcode=:Zipcode,Latitude=:Latitude,Longitude=:Longitude,UpdateDate=:UpdateDate WHERE RequestID=:RequestID");

        // Go Update
        $stmt->execute(array(
            'RequestID'       => $_POST['RequestID'],
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
            'UpdateDate'      => date("Y-m-d H:i:s"),
        ));
        $res['message'] = "Updated";
        echo json_encode($res, JSON_PRETTY_PRINT);

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

/*=====  End of Condition  ======*/
