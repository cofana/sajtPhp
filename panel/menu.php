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
                $query = "SELECT * FROM menu";
                $return = "
                <tr>
                <td></td>
                <td><input type='text' id='href' placeholder='href'></td>
                <td><input type='text' id='title' placeholder='title'></td>
                <td colspan='2'><input type='button' id='insertMenu' class='btn btn-dark w-75' value='Insert'></td>
                </tr>
                <tr>
                <td class='font-weight-bold'>menuID</td>
                <td class='font-weight-bold'>href</td>
                <td class='font-weight-bold'>title</td>
                <td class='font-weight-bold'>Update</td>
                <td class='font-weight-bold'>Delete</td>
                </tr>";
                $result = $con->query($query) ->fetchAll();
                foreach($result as $r){
                    $return .="<tr>
                    <td>$r->menuID</td>
                    <td><input type='text' value='$r->href'></td>
                    <td><input type='text' value='$r->title'></td>
                    <td><input type='button' class='btn btn-dark' name='updateMenu' id='$r->menuID' value='Update'></td>
                    <td><input type='button' class='btn btn-dark' name='deleteMenu' id='$r->menuID' value='Delete'</td>
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