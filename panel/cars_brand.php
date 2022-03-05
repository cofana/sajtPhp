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
                $query = "SELECT * FROM cars_brand";
                $return = "
                <tr>
                <td></td>
                <td><input type='text' id='carsBrandName' placeholder='Cars brand'></td>
                <td colspan='2'><input type='button' id='insertCarsBrand' class='btn btn-dark w-75' value='Insert'></td>
                </tr>
                <tr>
                <td class='font-weight-bold'>cars_brandID</td>
                <td class='font-weight-bold'>name</td>
                <td class='font-weight-bold'>Update</td>
                <td class='font-weight-bold'>Delete</td>
                </tr>";
                $result = $con->query($query) ->fetchAll();
                foreach($result as $r){
                    $return .="<tr>
                    <td>$r->cars_brandID</td>
                    <td><input type='text' value='$r->name'></td>
                    <td><input type='button' class='btn btn-dark' name='updateCarsBrand' id='$r->cars_brandID' value='Update'></td>
                    <td><input type='button' class='btn btn-dark' name='deleteCarsBrand' id='$r->cars_brandID' value='Delete'</td>
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