<?php
session_start();
if(empty($_SESSION["adminlogin"] )){
    header('Location: login.php');
    exit;
}
include_once './lib/Database.php';
include_once './lib/ForeignCurrency.php';


$database = new Database();
$db = $database->getConnection();

$xml=simplexml_load_file("http://www.cbr.ru/scripts/XML_daily.asp") or die("Error: Cannot create object");
//echo $xml->attributes()->Date;
//print_r($xml->children());
$empty = new ForeignCurrency($db);
$empty->Emptytable();

foreach($xml->children() as $ForeignCurrencys) {
    try {

        $Value = str_replace( ',', '', $ForeignCurrencys->Value );
        $item = new ForeignCurrency($db);
        $item->NumCode = $ForeignCurrencys->NumCode;
        $item->CharCode = $ForeignCurrencys->CharCode;
        $item->Nominal = $ForeignCurrencys->Nominal;
        $item->Name = $ForeignCurrencys->Name;
        $item->Value = $Value;
        $item->created = date("Y-m-d H:i:s", strtotime($xml->attributes()->Date));

        if($item->createForCurrency()){

        } else{

        }
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
    }

}


$items = new ForeignCurrency($db);

$stmt = $items->getAllForCurrency();
$itemCount = $stmt->rowCount();

?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>IT Grow Division Ltd</title>

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="index.php">IT Grow Division Ltd.</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" href="converter.php">Currencies Converter</a>
            </li>

        </ul>
    </div>
</nav>

<div class="container mt-5">
    <div id="login">
        <h3 class="text-center text-white pt-5">Login form</h3>
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mx-auto">

                    <div class="card">
                        <div class="card-header ">
                            List of currencies
                        </div>
                        <div class="card-body">
                            <strong> Total: <?=$itemCount?></strong>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">SortCode</th>
                                    <th scope="col">Value</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $i=1;
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    extract($row);

                                    ?>
                                    <tr>
                                        <th scope="row"><?=$i?></th>
                                        <td><?=$Name?></td>
                                        <td><?=$NumCode?></td>
                                        <td><?=$CharCode?></td>
                                        <td><?=$Value?></td>
                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

</body>

</html>
