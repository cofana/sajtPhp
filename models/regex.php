<?php
    //REGEX
    define("REGEX_USERNAME" , "/^[A-z][A-z0-9@#$%^&*]{3,20}$/");
    define("REGEX_PASSWORD" , "/^(?=.*[A-Z])(?=.*[0-9])[A-z0-9$%^&*]{8,}$/");
    define("REGEX_NAMES" , "/^[A-Z][a-z]{2,20}$/");
    //ERRORS
    define("ERROR_FIRSTNAME" , "First name needs to start with first capital letter and length of minimum 3");
    define("ERROR_LASTNAME","Last name needs to start with first capital letter and length of minimum 3");
    define("ERROR_EMAIL" ,"Email is not in valid format.  Example: john123@gmail.com");
    define("ERROR_USERNAME", "Username needs to start with a letter and length of minimum 3");
    define("ERROR_PASSWORD", "Password needs to have at least one big letter, one number and length of minimum 8");
    define("ERROR_MESSAGE","Message needs to be at least 30 characters long");
?>