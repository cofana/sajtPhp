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
                $query = "SELECT * FROM contact";
                $return = "
                <tr>
                <td class='font-weight-bold'>contactID</td>
                <td class='font-weight-bold'>firstName</td>
                <td class='font-weight-bold'>lastName</td>
                <td class='font-weight-bold'>email</td>
                <td class='font-weight-bold'>message</td>
                <td class='font-weight-bold'>Delete</td>
                </tr>";
                $result = $con->query($query) ->fetchAll();
                foreach($result as $r){
                    $return .="<tr>
                    <td>$r->contactID</td>
                    <td>$r->firstName</td>
                    <td>$r->lastName</td>
                    <td>$r->email</td>
                    <td>$r->message</td>
                    <td><input type='button' class='btn btn-dark' name='deleteContact' id='$r->contactID' value='Delete'</td>
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