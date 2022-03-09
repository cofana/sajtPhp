<?php
    header("Content-type: application/json");
    if(!isset($_SESSION)){
        session_start();
    }
    try{
        if(isset($_SESSION["korisnik"])){
            include_once("../data/connection.php");
            $carID = $_GET["carIDPHP"];
            $query = "SELECT * FROM cars WHERE carsID = :carID";
            $prepared = $con -> prepare($query);
            $prepared ->bindParam(":carID", $carID);
            $prepared->execute();
            $result = $prepared -> fetch();
            if($result){
                $query = "SELECT *,cb2.name as cars_brandName, cb.name as cars_bodyName, d.name as driveName, t.Name as transmissionName FROM cars c JOIN images i ON i.imageID = c.imageID JOIN cars_body cb ON cb.cars_bodyID = c.cars_bodyID JOIN cars_brand cb2 ON cb2.cars_brandID = c.cars_brandID JOIN drive d ON d.driveID = c.driveID JOIN transmission t ON t.transmissionID = c.transmissionID WHERE c.carsID = :carID";
                $prepared = $con -> prepare($query);
                $prepared -> bindParam(":carID", $carID);
                $prepared -> execute();
                $result = $prepared ->fetch();
                echo json_encode(false);
            }
            else{
                echo json_encode(404);
            }
        }
        else{
            echo json_encode(true);
        }
    }
    catch(PDOException $e){
        http_response_code(500);
        echo $e->getMessage();
    }
?>