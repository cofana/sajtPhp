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
                if(result==0){
                    console.log("AAA");
                }
            },
            error: function(xhr){
                console.error(xhr);
            }
        })
    })
})