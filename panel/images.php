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
                $query = "SELECT * FROM images";
                $return = "
                <tr>
                <td></td>
                <td><input type='text' id='image' placeholder='Image name with extension'></td>
                <td><input type='button' id='insertImage' class='btn btn-dark' value='Insert'></td>
                </tr>
                <tr>
                <td class='font-weight-bold'>imageID</td>
                <td class='font-weight-bold'>Image name</td>
                <td class='font-weight-bold'>Delete</td>
                </tr>";
                $result = $con->query($query) ->fetchAll();
                foreach($result as $r){
                    $return .="<tr>
                    <td>$r->imageID</td>
                    <td><input type='text' value='$r->path'></td>
                    <td><input type='button' class='btn btn-dark' name='deleteImage' id='$r->imageID' value='Delete'</td>
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