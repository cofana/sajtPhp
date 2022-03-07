<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            include_once("../data/connection.php");
            $value = $_POST["valuePHP"];
            if($value == ""){
                echo json_encode(0);
            }
            $query = "SELECT *, cb.name as car_brandName FROM cars c JOIN cars_brand cb on c.cars_brandID = cb.cars_brandID JOIN images i ON i.imageID = c.imageID WHERE cb.name LIKE '%$value%' OR model LIKE '%$value%'  OR  CONCAT(model,' ', cb.name) LIKE '%$value%' OR  CONCAT(cb.name,' ', model) LIKE '%$value%' LIMIT 4";
            $result = $con ->query($query)->fetchAll();
            if($result){
                echo json_encode($result);
            }
            else{
                echo json_encode(0);
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