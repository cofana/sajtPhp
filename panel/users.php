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
                <td class='font-weight-bold'>Username</td>
                <td class='font-weight-bold'>Password</td>
                <td class='font-weight-bold'>Timestamp</td>
                <td class='font-weight-bold'>Email</td>
                <td class='font-weight-bold'>First name</td>
                <td class='font-weight-bold'>Last name</td>
                <td class='font-weight-bold'>Role</td>
                <td class='font-weight-bold'>Voted</td>
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