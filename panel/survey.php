<?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (!isset($_SESSION['korisnik'])) {
                session_start();
            }
            if ($_SESSION['korisnik']->role != "administrator") {
                http_response_code(404);
            }
            if ($_SESSION['korisnik']->role == "administrator") {
            try{
                include_once("../functions.php");
                include_once("../data/connection.php");
                $query = "SELECT * FROM survey";
                $return = "
                <tr>
                <td></td>
                <td><input type='text' id='question' placeholder='New question - varchar'></td>
                <td colspan='2'><input type='button' id='insertSurvey' class='btn btn-dark w-75' value='Insert'></td>
                </tr>
                <tr>
                <td class='font-weight-bold'>surveyID</td>
                <td class='font-weight-bold'>Survey question</td>
                <td class='font-weight-bold'>Update</td>
                <td class='font-weight-bold'>Delete</td>
                </tr>";
                $result = $con->query($query) ->fetchAll();
                foreach($result as $r){
                    $return .="<tr>
                    <td>$r->surveyID</td>
                    <td><input type='text' value='$r->question'></td>
                    <td><input type='button' class='btn btn-dark' name='updateSurvey' id='$r->surveyID' value='Update'></td>
                    <td><input type='button' class='btn btn-dark' name='deleteSurvey' id='$r->surveyID' value='Delete'</td>
                    </tr>";
                }
                echo json_encode($return);
            }
            catch(PDOException $e){
                http_response_code(500);
                echo $e->getMessage();
            }
        }
    }
    }
    else{
        http_response_code(404);
    }
    
?>