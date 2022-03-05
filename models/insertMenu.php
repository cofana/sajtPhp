<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            include_once("../functions.php");
            include_once("../data/connection.php");
            $title= $_POST["titlePHP"];
            $href = $_POST["hrefPHP"];
            $query = "INSERT INTO menu VALUES (null, :href, :title)";
            $prepared = $con->prepare($query);
            $prepared -> bindParam(":href", $href);
            $prepared -> bindParam(":title", $title);
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