<?php
    header("Content-type: application/json");
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        try{
            include_once("../functions.php");
            include_once("../data/connection.php");
            $answerName= $_POST["answerNamePHP"];
            $votes = $_POST["votesPHP"];
            $surveyID = $_POST["surveyIDPHP"];
            $query = "INSERT INTO answers VALUES (null, :answerName, :votes, :surveyID)";
            $prepared = $con->prepare($query);
            $prepared -> bindParam(":answerName", $answerName);
            $prepared -> bindParam(":votes", $votes);
            $prepared -> bindParam(":surveyID", $surveyID);
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