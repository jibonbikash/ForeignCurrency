<?php
/**
 * Created by  jibon Bikash Roy.
 * User: jibon
 * Date: 8/29/20
 * Time: 11:46 PM
 * Copyright jibon <jibon.bikash@gmail.com>
 */

$total='';
$string='';
if($_POST['Submit']){
    $from = $_POST["from"];
    $to = $_POST["to"];
    $amount = $_POST["amount"];

    $string = $from . "_" . $to;

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://free.currconv.com/api/v7/convert?q=" . $string . "&compact=ultra&apiKey=dacbe4a89382292b72c1",
        CURLOPT_RETURNTRANSFER => 1
    ));

    $response = curl_exec($curl);

    $response = json_decode($response, true);

    $rate = $response[$string];
    $total = $rate * $amount;

}


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
                            Currencies Converter
                        </div>
                        <div class="card-body">
                            <strong>
                                <?php
                                if(isset($string)){
                                    echo $string.' => '.$total;
                                }
                                ?>
                            </strong>

                            <form method="POST" action="">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="from" placeholder="From" required/>
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" name="to" placeholder="To" required />
                                </div>

                                <div class="form-group">
                                    <input type="number" class="form-control" name="amount" placeholder="Amount" required />
                                </div>
<input type="hidden" name="Submit" value="Submited">
                                <button type="submit" class="btn btn-primary" >Convert</button>

                            </form>



                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>

</body>

</html>

