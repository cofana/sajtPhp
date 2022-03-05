<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        try{
            include_once("../data/connection.php");
            include_once("../functions.php");
            $transmissionID = $_POST["IDPHP"];
            $query= "DELETE FROM transmission WHERE transmissionID = :transmissionID";
            $prepared = $con->prepare($query);
            $prepared ->bindParam(":transmissionID", $transmissionID);
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