<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            include_once("../functions.php");
            include_once("../data/connection.php");
            $transmissionID = $_POST["transmissionIDPHP"];
            $name= $_POST["namePHP"];
            $query = "UPDATE transmission SET name = :name WHERE transmissionID = :transmissionID";
            $prepared = $con->prepare($query);
            $prepared -> bindParam(":name", $name);
            $prepared -> bindParam(":transmissionID", $transmissionID);
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