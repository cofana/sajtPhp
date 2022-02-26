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

        $.ajax({
            url: "models/registracija.php",
            method: "post",
            data: podaciZaSlanje,
            datatype: "json",
            success: function(result){
                $("#odgovor").html(`<p class="alert succRegister"> ${result.poruka} </p>`)
            },
            error: function(xhr){
                console.error(xhr);
                // if 500..
                // if 404..
            }
        })
    })


    //logovanje

    $(document).on('click', '#btnLogovanje', function(){
        let user, lozinka;
        user = $('#user');
        lozinka = $('$pass');
        brojGresaka = 0;

        //regularni izrazi

        //provera

        if(brojGresaka==0){

        }
    })
})

// ajax callback function
function ajaxCallBack(url, method, result){
    $.ajax({
        url: url,
        method: method,
        dataType: "json",
        success: result,
        error: function(xhr){
            console.log(xhr);
            //if 500..
            //if 404..
        }
    })
}