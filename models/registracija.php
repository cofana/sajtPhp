<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        try{
            
            include_once "../data/connection.php";
            include_once "../functions.php";
            include_once "regex.php";

            
            $ime = $_POST['imePHP'];
            $prezime = $_POST['prezimePHP'];
            $email = $_POST['emailPHP'];
            $username = $_POST['usernamePHP'];
            $lozinka = $_POST['lozinkaPHP'];
            $sifrovanaLozinka = md5($lozinka);
            

            check(REGEX_NAMES, $ime, ERROR_FIRSTNAME);
            check(REGEX_NAMES, $prezime, ERROR_LASTNAME);
            check(REGEX_USERNAME, $username, ERROR_USERNAME);
            check(REGEX_PASSWORD, $lozinka, ERROR_PASSWORD);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors,ERROR_EMAIL);}


            
            if(count($errors)==0){
                $unosKorisnika = unosKorisnika($ime, $prezime, $email, $username, $sifrovanaLozinka);
                if($unosKorisnika){

                    $odgovor = ["poruka" => "Succesfully Registered"];
                    echo json_encode($odgovor);
                    http_response_code(201);
                }
            }
            

            else echo json_encode(0);
            


        }catch(PDOException $exception){
            http_response_code(500);
        }

    }
    else{
        http_response_code(404);
    }




?>