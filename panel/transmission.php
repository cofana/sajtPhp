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
                $query = "SELECT * FROM transmission";
                $return = "
                <tr>
                <td></td>
                <td><input type='text' id='transmissionName' placeholder='Transmission'></td>
                <td colspan='2'><input type='button' id='insertTransmission' class='btn btn-dark w-75' value='Insert'></td>
                </tr>
                <tr>
                <td class='font-weight-bold'>transmissionID</td>
                <td class='font-weight-bold'>name</td>
                <td class='font-weight-bold'>Update</td>
                <td class='font-weight-bold'>Delete</td>
                </tr>";
                $result = $con->query($query) ->fetchAll();
                foreach($result as $r){
                    $return .="<tr>
                    <td>$r->transmissionID</td>
                    <td><input type='text' value='$r->name'></td>
                    <td><input type='button' class='btn btn-dark' name='updateTransmission' id='$r->transmissionID' value='Update'></td>
                    <td><input type='button' class='btn btn-dark' name='deleteTransmission' id='$r->transmissionID' value='Delete'</td>
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