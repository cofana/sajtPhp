<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            include_once("../functions.php");
            include_once("../data/connection.php");
            $carsBrandID= $_POST["carsBrandIDPHP"];
            $model = $_POST["modelPHP"];
            $km= $_POST["kmPHP"];
            $driveID = $_POST["driveIDPHP"];
            $carsBodyID= $_POST["carsBodyIDPHP"];
            $fuelID = $_POST["fuelIDPHP"];
            $seatsID = $_POST["seatsIDPHP"];
            $topSpeed= $_POST["topSpeedPHP"];
            $kw= $_POST["kwPHP"];
            $transmissionID= $_POST["transmissionIDPHP"];
            $color= $_POST["colorPHP"];
            $imageID= $_POST["imageIDPHP"];
            $price= $_POST["pricePHP"];
            $query = "INSERT INTO cars VALUES (null, :carsBrandID, :model, :km, :driveID,:carsBodyID, :fuelID, :seatsID, :topSpeed, :kw,:transmissionID, :color, :imageID, :price)";
            $prepared = $con->prepare($query);
            $prepared -> bindParam(":carsBrandID", $carsBrandID);
            $prepared -> bindParam(":model", $model);
            $prepared -> bindParam(":km", $km);
            $prepared -> bindParam(":driveID", $driveID);
            $prepared -> bindParam(":carsBodyID", $carsBodyID);
            $prepared -> bindParam(":fuelID", $fuelID);
            $prepared -> bindParam(":seatsID", $seatsID);
            $prepared -> bindParam(":topSpeed", $topSpeed);
            $prepared -> bindParam(":kw", $kw);
            $prepared -> bindParam(":transmissionID", $transmissionID);
            $prepared -> bindParam(":color", $color);
            $prepared -> bindParam(":imageID", $imageID);
            $prepared -> bindParam(":price", $price);
            $result = $prepared ->execute();
            echo json_encode($result);
        }
        catch(PDOException $e){
            http_response_code(500);
            echo $e->getMessage();
            echo json_encode(0);
        }
    }
    else{
        http_response_code(404);
    }
?>