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
                $query = "SELECT * FROM seats";
                $return = "
                <tr>
                <td></td>
                <td><input type='text' id='seat' placeholder='seat'></td>
                <td><input type='button' id='insertSeats' class='btn btn-dark' value='Insert'></td>
                </tr>
                <tr>
                <td class='font-weight-bold'>seatsID</td>
                <td class='font-weight-bold'>number</td>
                <td class='font-weight-bold'>Delete</td>
                </tr>";
                $result = $con->query($query) ->fetchAll();
                foreach($result as $r){
                    $return .="<tr>
                    <td>$r->seatsID</td>
                    <td><input type='text' value='$r->number'></td>
                    <td><input type='button' class='btn btn-dark' name='deleteSeats' id='$r->seatsID' value='Delete'</td>
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