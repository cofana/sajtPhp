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
                $query = "SELECT *,cb2.name as cars_brandName, f.name as fuelName, cb.name as cars_bodyName, d.name as driveName, t.Name as transmissionName FROM cars c JOIN images i ON i.imageID = c.imageID JOIN cars_body cb ON cb.cars_bodyID = c.cars_bodyID JOIN fuel f ON f.fuelID = c.fuelID JOIN cars_brand cb2 ON cb2.cars_brandID = c.cars_brandID JOIN drive d ON d.driveID = c.driveID JOIN seats s ON s.seatsID = c.seatsID JOIN transmission t ON t.transmissionID = c.transmissionID";
                $return = "
                <tr>
                <td></td>
                <td><input type='text' id='carsBrandID' placeholder='cars_brandID'></td>
                <td><input type='text' id='model' placeholder='model'></td>
                <td><input type='text' id='km' placeholder='km'></td>
                <td><input type='text' id='driveID' placeholder='driveID'></td>
                <td><input type='text' id='carsBodyID' placeholder='cars_bodyID'></td>
                <td><input type='text' id='fuelID' placeholder='fuelID'></td>
                <td><input type='text' id='seatsNumber' placeholder='seatsNumber'></td>
                <td><input type='text' id='topSpeed' placeholder='top_speed'></td>
                <td><input type='text' id='kw' placeholder='kw'></td>
                <td><input type='text' id='transmissionID' placeholder='transmissionID'></td>
                <td><input type='text' id='color' placeholder='color'></td>
                <td><input type='text' id='imageID' placeholder='imageID'></td>
                <td><input type='text' id='price' placeholder='price'></td>
                <td colspan='2'><input type='button' id='insertCar' class='btn btn-dark w-75' value='Insert'></td>
                </tr>
                <tr>
                <td class='font-weight-bold'>carsID</td>
                <td class='font-weight-bold'>cars_brandName</td>
                <td class='font-weight-bold'>model</td>
                <td class='font-weight-bold'>km</td>
                <td class='font-weight-bold'>driveName</td>
                <td class='font-weight-bold'>cars_bodyName</td>
                <td class='font-weight-bold'>fuelName</td>
                <td class='font-weight-bold'>seatsNumber</td>
                <td class='font-weight-bold'>top_speed</td>
                <td class='font-weight-bold'>kw</td>
                <td class='font-weight-bold'>transmissionName</td>
                <td class='font-weight-bold'>color</td>
                <td class='font-weight-bold'>imageID</td>
                <td class='font-weight-bold'>price</td>
                <td class='font-weight-bold' colspan='2'>Delete</td>
                </tr>";
                $result = $con->query($query) ->fetchAll();
                foreach($result as $r){
                    $return .="<tr>
                    <td>$r->carsID</td>
                    <td>$r->cars_brandName</td>
                    <td>$r->model</td>
                    <td>$r->km</td>
                    <td>$r->driveName</td>
                    <td>$r->cars_bodyName</td>
                    <td>$r->fuelName</td>
                    <td>$r->number</td>
                    <td>$r->top_speed</td>
                    <td>$r->kw</td>
                    <td>$r->transmissionName</td>
                    <td>$r->color</td>
                    <td>$r->imageID</td>
                    <td>$r->price</td>
                    <td><input type='button' class='btn btn-dark'  colspan='2' name='deleteCar' id='$r->carsID' value='Delete'</td>
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