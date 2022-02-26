<?php
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

?>