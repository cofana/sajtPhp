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
                $query = "SELECT * FROM users_cars";
                $return = "
                <tr>
                <td class='font-weight-bold'>users_carsID</td>
                <td class='font-weight-bold'>userID</td>
                <td class='font-weight-bold'>carsID</td>
                <td class='font-weight-bold'>beginDate</td>
                <td class='font-weight-bold'>endDate</td>
                <td class='font-weight-bold'>totalPrice</td>
                <td class='font-weight-bold' colspan='2'>Delete</td>
                </tr>";
                $result = $con->query($query) ->fetchAll();
                foreach($result as $r){
                    $return .="<tr>
                    <td>$r->users_carsID</td>
                    <td>$r->userID</td>
                    <td>$r->carsID</td>
                    <td>$r->beginDate</td>
                    <td>$r->endDate</td>
                    <td>$r->totalPrice</td>
                    <td><input type='button' class='btn btn-dark'  colspan='2' name='deleteUsersCars' id='$r->users_carsID' value='Delete'</td>
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