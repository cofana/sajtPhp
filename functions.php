<?php
    include "data/connection.php";
    function unosKorisnika($ime, $prezime, $email, $username, $lozinka){
        global $con;
        $upit = "INSERT INTO users VALUES (null,:username, :lozinka, CURRENT_TIMESTAMP, :email, :ime, :prezime,1, 0, 0)";

        $priprema = $con->prepare($upit);
        $priprema->bindParam(':username', $username);
        $priprema->bindParam(':lozinka', $lozinka);
        $priprema->bindParam(':email', $email);
        $priprema->bindParam(':ime', $ime);
        $priprema->bindParam(':prezime', $prezime);

        $rezultat = $priprema->execute();
        return $rezultat;
    }

    function proveraLogovanje($username, $password){
        global $con;

        $upit = "SELECT * FROM users u JOIN roles r ON u.roleID = r.roleID WHERE u.username = ? AND u.password = ?";

        $priprema = $con->prepare($upit);
        $priprema->execute([$username,$password]);

        $rezultat = $priprema->fetch();
        return $rezultat;
    }
    
    function check($regex, $input, $error){
        $errors = [];
        if(!isset($input) or empty($input) or !preg_match($regex,$input)){
            array_push($errors, $error);
        }
    }
    function insertContact($firstName,$lastName,$email,$message){
        global $con;
        $query = "INSERT INTO contact VALUES(null, :firstName,:lastName, :email,:message)";
        $prepared = $con ->prepare($query);
        $prepared ->bindParam(":firstName", $firstName);
        $prepared ->bindParam(":lastName", $lastName);
        $prepared ->bindParam(":email", $email);
        $prepared ->bindParam(":message", $message);
        $result = $prepared ->execute();
        return $result;
    }
    function showTable($ID){
        global $con;
        $query = "SELECT * FROM $ID";
        $result = $con->query($query)->fetchAll();
        return $result;
    }
?>