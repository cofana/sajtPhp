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
    $errors = array();
    function check($regex, $input, $error){
        if(!isset($input) or empty($input) or !preg_match($regex,$input)){
            array_push($errors, $error);
        }
    }
?>