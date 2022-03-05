<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            include_once("../functions.php");
            include_once("../data/connection.php");
            $carsBodyID = $_POST["carsBodyIDPHP"];
            $name= $_POST["namePHP"];
            $query = "UPDATE cars_body SET name = :name WHERE cars_bodyID = :carsBodyID";
            $prepared = $con->prepare($query);
            $prepared -> bindParam(":name", $name);
            $prepared -> bindParam(":carsBodyID", $carsBodyID);
            $result = $prepared ->execute();
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