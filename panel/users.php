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
                $query = "SELECT * from users u JOIN roles r on r.roleID = u.roleID";
                $return = "
                <tr>
                <td class='font-weight-bold'>userID</td>
                <td class='font-weight-bold'>username</td>
                <td class='font-weight-bold'>password</td>
                <td class='font-weight-bold'>timestamp</td>
                <td class='font-weight-bold'>email</td>
                <td class='font-weight-bold'>firstName</td>
                <td class='font-weight-bold'>lastName</td>
                <td class='font-weight-bold'>role</td>
                <td class='font-weight-bold'>active</td>
                <td class='font-weight-bold'>code</td>
                <td class='font-weight-bold'>voted</td>
                <td class='font-weight-bold' colspan='2'>Delete</td>
                </tr>";
                $result = $con->query($query) ->fetchAll();
                foreach($result as $r){
                    $return .="<tr>
                    <td>$r->userID</td>
                    <td>$r->username</td>
                    <td>$r->password</td>
                    <td>$r->timestamp</td>
                    <td>$r->email</td>
                    <td>$r->firstName</td>
                    <td>$r->lastName</td>
                    <td>$r->roleID</td>
                    <td>$r->active</td>
                    <td>$r->code</td>
                    <td>$r->voted</td>
                    <td><input type='button' class='btn btn-dark' colspan='2' name='deleteUser' id='$r->userID' value='Delete'></td>
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