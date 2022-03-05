<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            include_once("../functions.php");
            include_once("../data/connection.php");
            $carsBrandID = $_POST["carsBrandIDPHP"];
            $name= $_POST["namePHP"];
            $query = "UPDATE cars_brand SET name = :name WHERE cars_brandID = :carsBrandID";
            $prepared = $con->prepare($query);
            $prepared -> bindParam(":name", $name);
            $prepared -> bindParam(":carsBrandID", $carsBrandID);
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