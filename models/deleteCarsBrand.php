<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        try{
            include_once("../data/connection.php");
            include_once("../functions.php");
            $carsBrandID = $_POST["IDPHP"];
            $query= "DELETE FROM cars_brand WHERE cars_brandID = :cars_brandID";
            $prepared = $con->prepare($query);
            $prepared ->bindParam(":cars_brandID", $carsBrandID);
            $result = $prepared->execute();
            echo json_encode($result);
        }
        catch(PDOException $e){
            http_response_code(500);
            echo $e->getMessage();
        }
    }
    else{
        http_response_code(404);
    }
?>