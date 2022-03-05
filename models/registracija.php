<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        try{
            
            include_once "../data/connection.php";
            include_once "../functions.php";
            include_once "regex.php";

            $ime = $_POST['ime'];
            $prezime = $_POST['prezime'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $lozinka = md5($_POST['lozinka']);

            

            $unosKorisnika = unosKorisnika($ime, $prezime, $email, $username, $lozinka);
            if($unosKorisnika){

                

                $odgovor = ["poruka" => "Uspesan unos"];
                echo json_encode($odgovor);
                http_response_code(201);
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