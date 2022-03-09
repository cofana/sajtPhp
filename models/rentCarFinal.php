<?php
    header("Content-type: application/json");
    if(!isset($_SESSION)){
        session_start();
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            include_once("../functions.php");
            include_once("../data/connection.php");
            $username = $_SESSION['korisnik']->username;
            
            $query = "SELECT userID FROM users WHERE username = '$username'";
            $result = $con ->query($query) ->fetch();
            $userID = $result->userID;
            $carID = $_POST["carIDPHP"];
            $beginDate = $_POST["beginDatePHP"];
            $endDate = $_POST["endDatePHP"];
            $totalPrice = $_POST["totalPricePHP"];
            $result = insertUsersCars($userID,$carID,$beginDate,$endDate,$totalPrice);
            if($result){
                echo json_encode(1);
            }
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