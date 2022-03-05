<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        try{
            include_once("../data/connection.php");
            include_once("../functions.php");
            $carsBodyID = $_POST["IDPHP"];
            $query= "DELETE FROM cars_body WHERE cars_bodyID = :cars_bodyID";
            $prepared = $con->prepare($query);
            $prepared ->bindParam(":cars_bodyID", $carsBodyID);
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