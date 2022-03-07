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
    function insertUsersCars($userID, $carID, $beginDate, $endDate,$totalPrice){
        global $con;
        $query = "INSERT INTO users_cars VALUES (null, :userID, :carID, :beginDate, :endDate, :totalPrice)";
        $prepared = $con->prepare($query);
        $prepared ->bindParam(":userID", $userID);
        $prepared ->bindParam(":carID", $carID);
        $prepared ->bindParam(":beginDate", $beginDate);
        $prepared ->bindParam(":endDate", $endDate);
        $prepared ->bindParam(":totalPrice", $totalPrice);
        $result = $prepared ->execute();
        return $result;
    }
    function showPercents($surveyID){
        global $con;
        $percents = [];
        $query = "SELECT * , (SELECT (ROUND(a.votes/SUM(votes),2)*100) FROM answers) as percentage FROM answers a WHERE surveyID = :surveyID";
        $prepared = $con ->prepare($query);
        $prepared ->bindParam(":surveyID", $surveyID);
        $prepared ->execute();
        $result = $prepared ->fetchAll();
        foreach($result as $res){
            array_push($percents , $res->percentage);
        } 
        return $percents;
    }
    function updateSurvey($answerID,$username){
        global $con;
        $query = "UPDATE answers SET votes = votes + 1 WHERE answerID = :answerID";
        $prepared = $con -> prepare($query);
        $prepared ->bindParam(":answerID", $answerID);
        $result = $prepared ->execute();
        $query = "UPDATE users SET voted = 1 WHERE username=:username";
        $prepared = $con->prepare($query);
        $prepared ->bindParam(":username", $username);
        $prepared ->execute();
        return $result;
    }
    function showTable($ID){
        global $con;
        $query = "SELECT * FROM $ID";
        $result = $con->query($query)->fetchAll();
        return $result;
    }
?>