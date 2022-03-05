<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == 'POST'){
        try{
            include_once("../data/connection.php");
            include_once("../functions.php");
            $users_carsID = $_POST["IDPHP"];
            $query= "DELETE FROM users_cars WHERE users_carsID = :users_carsID";
            $prepared = $con->prepare($query);
            $prepared ->bindParam(":users_carsID", $users_carsID);
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