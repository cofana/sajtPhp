<?php
    if(!isset($_SESSION)){
        session_start();
    }
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            include_once("../data/connection.php");
            include_once("../functions.php");
            global $con;
            $username = $_SESSION["korisnik"]->username;
            $answerID = $_POST["answerIDPHP"];
            updateSurvey($answerID,$username);
            echo json_encode(1);
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