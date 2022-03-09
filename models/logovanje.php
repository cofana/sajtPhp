<?php
    session_start();
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include_once "../functions.php";
        
        try{
            include_once "../data/connection.php";
            include_once "regex.php";
            $user = $_POST['user'];
            $pass = $_POST['pass'];
            $sifrovaniPass = md5($pass);

            check(REGEX_USERNAME,$user,ERROR_USERNAME);
            check(REGEX_PASSWORD,$pass,ERROR_PASSWORD);

            
            if(count($errors)==0){
                $korisnikObj = proveraLogovanje($user, $sifrovaniPass);

                if($korisnikObj){
                    $_SESSION['korisnik'] = $korisnikObj;
                    

                    $odgovor = ["poruka"=>"Uspesno logovanje"];
                    echo json_encode($odgovor);
                    http_response_code(200);
                }
            }


        }catch(PDOException $exception){
            http_response_code(500);
        }

    }
    else{
        http_response_code(404);
    }




?>