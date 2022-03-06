<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        
        try{
            include_once("../functions.php");
            include_once("../data/connection.php");
            include_once("regex.php");
            $firstName = $_POST["firstNamePHP"];
            $lastName = $_POST["lastNamePHP"];
            $email = $_POST["emailPHP"];
            $message = $_POST["messagePHP"];
            $errors = [];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors,ERROR_EMAIL);
            }
            // check(REGEX_NAMES,$firstName,ERROR_FIRSTNAME);
            // check(REGEX_NAMES,$lastName,ERROR_LASTNAME);
            if (!isset($message) OR empty($message) OR strlen($message) < 15){
                array_push($errors, ERROR_MESSAGE);
            }
            if(count($errors) == 0){
                $result = insertContact($firstName,$lastName,$email,$message);
                echo json_encode($result);
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