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
                $queryForBrands = "SELECT * FROM cars_brand";
                $brend = $con->query($queryForBrands)->fetchAll();
                $queryForDrive = "SELECT * FROM drive";
                $drive = $con->query($queryForDrive)->fetchAll();
                $queryForBody = "SELECT * FROM cars_body";
                $body = $con->query($queryForBody)->fetchAll();
                $queryForFuel = "SELECT * FROM fuel";
                $fuel = $con->query($queryForFuel)->fetchAll();
                $queryForSeats = "SELECT * FROM seats";
                $seats = $con->query($queryForSeats)->fetchAll();
                $queryForTransmission = "SELECT * FROM transmission";
                $transmission = $con->query($queryForTransmission)->fetchAll();
                $return = "
                <tr>
                <td></td>
                <td><select id='carsBrandID'>";

                    foreach ($brend as $b){
                        $return .=" <option value='$b->cars_brandID'>$b->name</option>";
                    }

                $return .= "</select></td>
                <td><input type='text' id='model' placeholder='Model name - varchar'></td>
                <td><input type='text' id='km' placeholder='Mileage(in km) - int'></td>
                <td><select id='driveID'>";

                    foreach ($drive as $d){
                        $return .=" <option value='$d->driveID'>$d->name</option>";
                    }
                
                $return .="</select></td>
                <td><select id='carsBodyID'>";

                    foreach ($body as $bd){
                        $return .=" <option value='$bd->cars_bodyID'>$bd->name</option>";
                    }
                
                $return .= "</select></td>
                <td><select id='fuelID'>";

                    foreach ($fuel as $f){
                        $return .=" <option value='$f->fuelID'>$f->name</option>";
                    }
                
                $return .= "</select></td>
                <td><select id='seatsID'>";

                    foreach ($seats as $s){
                        $return .=" <option value='$s->seatsID'>$s->number</option>";
                    }
                
                $return .= "</select></td>
                <td><input type='text' id='topSpeed' placeholder='Top speed in km/h - int'></td>
                <td><input type='text' id='kw' placeholder='KW - int'></td>
                <td><select id='transmissionID'>";

                    foreach ($transmission as $tm){
                        $return .=" <option value='$tm->transmissionID'>$tm->name</option>";
                    }
                
                $return .= "</select></td>
                <td><input type='text' id='color' placeholder='Color - varchar'></td>
                <td><input type='text' id='imageID' placeholder='imageID - int'></td>
                <td><input type='text' id='price' placeholder='Price - int'></td>
                <td colspan='2'><input type='button' id='insertCar' class='btn btn-dark' value='Insert'></td>
                </tr>
                <tr>
                <td class='font-weight-bold'>carsID</td>
                <td class='font-weight-bold'>Brand name</td>
                <td class='font-weight-bold'>Model name</td>
                <td class='font-weight-bold'>Mileage</td>
                <td class='font-weight-bold'>Drive</td>
                <td class='font-weight-bold'>Car body</td>
                <td class='font-weight-bold'>Fuel type</td>
                <td class='font-weight-bold'>Number of seats</td>
                <td class='font-weight-bold'>Top speed</td>
                <td class='font-weight-bold'>KW</td>
                <td class='font-weight-bold'>Transmission</td>
                <td class='font-weight-bold'>Color</td>
                <td class='font-weight-bold'>imageID</td>
                <td class='font-weight-bold'>Price in euros</td>
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