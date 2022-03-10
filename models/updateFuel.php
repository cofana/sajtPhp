<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            include_once("../functions.php");
            include_once("../data/connection.php");
            $fuelID = $_POST["fuelIDPHP"];
            $name= $_POST["namePHP"];
            $query = "UPDATE fuel SET name = :name WHERE fuelID = :fuelID";
            $prepared = $con->prepare($query);
            $prepared -> bindParam(":name", $name);
            $prepared -> bindParam(":fuelID", $fuelID);
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