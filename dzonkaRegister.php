<?php
header("Content-type: application/json");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include "../data/konekcija.php";
    include "functions.php";
    include "regex.php";
    try {

        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $ime = $_POST['ime'];
        $prezime = $_POST['prezime'];
        $sifrovanPassword = md5($password);
        check(REGEX_USERNAME, $username, ERROR_USERNAME);
        check(REGEX_PASSWORD, $password, ERROR_PASSWORD);
        check(REGEX_IMEPREZIME, $ime, ERROR_IME);
        check(REGEX_IMEPREZIME, $prezime, ERROR_PREZIME);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, ERROR_EMAIL);
        }
        if (count($errors) == 0) {
            $unosKorisnika = unosKorisnika($username, $sifrovanPassword, $email, $ime, $prezime);
            if ($unosKorisnika) {
                $odgovor = ["poruka" => "Uspesan unos"];
                echo json_encode($odgovor);
                http_response_code(201);
            }
        }
    } catch (PDOException $exception) {
        echo $exception->getMessage();
        http_response_code(500);
    }
} else {
    http_response_code(404);
}
