<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            include_once("../functions.php");
            include_once("../data/connection.php");
            $answerID = $_POST["answerIDPHP"];
            $answerName= $_POST["answerNamePHP"];
            $votes = $_POST["votesPHP"];
            $query = "UPDATE answers SET answerName = :answerName, votes= :votes WHERE answerID = :answerID";
            $prepared = $con->prepare($query);
            $prepared -> bindParam(":answerName", $answerName);
            $prepared -> bindParam(":votes", $votes);
            $prepared -> bindParam(":answerID", $answerID);
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