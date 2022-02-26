$(document).ready(function(){
    //registracija korisnika
    $(document).on('click', '#registerButton', function(){
        let ime, prezime, email, lozinka, username, brojGresaka;
        ime = $('#name');
        prezime = $('#lastname');
        email = $('#mail');
        lozinka = $('#passR');
        username = $('#userR');
        brojGresaka = 0;

        //regularni izrazi
        // provera

        if($(ime).val() == ""){
            brojGresaka++;
            $(ime).addClass('errorMine');
        }
        else{
            $(ime).removeClass('errorMine');
        }

        var podaciZaSlanje;
        if(brojGresaka==0){
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
                console.log(result)
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
            console.log(xhr);
            //if 500..
            //if 404..
        }
    })
}