<?php
/**
 * Created by  jibon Bikash Roy.
 * User: jibon
 * Date: 8/29/20
 * Time: 11:32 PM
 * Copyright jibon <jibon.bikash@gmail.com>
 */

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../lib/Database.php';
include_once '../lib/ForeignCurrency.php';


$database = new Database();
$db = $database->getConnection();

$items = new ForeignCurrency($db);

$stmt = $items->getAllForCurrency();
$itemCount = $stmt->rowCount();


//echo json_encode($itemCount);

if($itemCount > 0){

    $ForeignCurrencyArr = array();
    $ForeignCurrencyArr["data"] = array();
    $ForeignCurrencyArr["itemCount"] = $itemCount;

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $e = array(
            "id" => $id,
            "NumCode" => $NumCode,
            "CharCode" => $CharCode,
            "Nominal" => $Nominal,
            "Name" => $Name,
            "Value" => $Value,
            "created" => $created
        );

        array_push($ForeignCurrencyArr["data"], $e);
    }
    echo json_encode($ForeignCurrencyArr);
}

else{
    http_response_code(404);
    echo json_encode(
        array("message" => "No record found.")
    );
}