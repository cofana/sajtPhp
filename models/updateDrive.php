<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            include_once("../functions.php");
            include_once("../data/connection.php");
            $driveID = $_POST["driveIDPHP"];
            $name= $_POST["namePHP"];
            $query = "UPDATE drive SET name = :name WHERE driveID = :driveID";
            $prepared = $con->prepare($query);
            $prepared -> bindParam(":name", $name);
            $prepared -> bindParam(":driveID", $driveID);
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