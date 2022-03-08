<?php
    session_start();
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include_once "../functions.php";
        
        try{
            include_once "../data/connection.php";
            include_once "regex.php";
            $user = $_POST['user'];
            $pass = md5($_POST['pass']);

            

            $korisnikObj = proveraLogovanje($user, $pass);

            if($korisnikObj){
                $_SESSION['korisnik'] = $korisnikObj;
                
                // $_SESSION['korisnik_id'] = $korisnikObj->userID;

                $odgovor = ["poruka"=>"Uspesno logovanje"];
                echo json_encode($odgovor);
                http_response_code(200);
            }


        }catch(PDOException $exception){
            http_response_code(500);
        }

    }
    else{
        http_response_code(404);
    }




?>