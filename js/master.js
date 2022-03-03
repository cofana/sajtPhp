$(document).ready(function(){
    const regImePrezime = /^[A-Z][a-z]{2,20}$/;
    const regUsername = /^[A-z][A-z0-9@#$%^&*]{3,20}$/;
    const regPassword = /^(?=.*[A-Z])(?=.*[0-9])[A-z0-9$%^&*]{8,}$/;
    const regEmail = /^(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])$/;
    const IME_ERROR = "First name needs to start with first capital letter and length of minimum 3";
    const PREZIME_ERROR = "Last name needs to start with first capital letter and length of minimum 3";
    const USERNAME_ERROR = "Username needs to start with a letter and length of minimum 3";
    const PASSWORD_ERROR = "Password needs to have at least one big letter, one number and length of minimum 8";
    const EMAIL_ERROR = "Email is not in valid format.  Example: filip123@gmail.com";
    var errors = [];
    function check(input, regex, error, div) {
      if (!regex.test(input)) {
        errors.push(error);
        div.text(error);
      }
    }

    //registracija korisnika
    $(document).on('click', '#registerButton', function(){
        let ime, prezime, email, lozinka, username;
        ime = $('#name');
        prezime = $('#lastname');
        email = $('#mail');
        lozinka = $('#passR');
        username = $('#userR');
        var errors = [];
        var usernameError = $("#userError");
        var passwordError = $("#passError");
        var imeError = $("#imeError");
        var prezimeError = $("#prezimeError");
        var emailError = $("#emailError");
        usernameError.text("");
        passwordError.text("");
        imeError.text("");
        prezimeError.text("");
        emailError.text("");

        check(username,regUsername,USERNAME_ERROR,usernameError);
        check(password,regPassword,PASSWORD_ERROR,passwordError);
        check(firstName,regImePrezime,IME_ERROR,imeError);
        check(lastName,regImePrezime,PREZIME_ERROR,prezimeError);
        check(email,regEmail,EMAIL_ERROR,emailError);
        

        var podaciZaSlanje;
        if(errors.length==0){
             podaciZaSlanje = {
                ime: $(ime).val(),
                prezime: $(prezime).val(),
                email: $(email).val(),
                lozinka: $(lozinka).val(),
                username: $(username).val()
            }
        }

        ajaxCallBack("models/registracija.php", "post", podaciZaSlanje, function(result){
            $("#odgovor").html(`<p class="alert succRegister"> ${result.poruka} </p>`)
        })

        
    })


    //logovanje

    $(document).on('click', '#loginButton', function(){
        let brojGresaka = 0;
        //regularni izrazi

        //provera
        var podaciZaSlanje;
        if(brojGresaka==0){
            podaciZaSlanje={
                user: $("#user").val(),
                pass: $("#pass").val()
            }
            ajaxCallBack("models/logovanje.php", "post", podaciZaSlanje, function(result){
                 window.location.replace("index.php");
                // $("#odgovor").html(`<p class="alert succRegister"> ${result.poruka} </p>`)
            })
        }
    })
})

// ajax callback function
function ajaxCallBack(url, method, data, result){
    $.ajax({
        url: url,
        method: method,
        data: data,
        dataType: "json",
        success: result,
        error: function(xhr){
            /* console.log(xhr); */
            //if 500..
            //if 404..
        }
    })
}