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
        let firstName, lastName, email, password, username;
        firstName = $('#name').val();
        lastName = $('#lastname').val();
        email = $('#mail').val();
        password = $('#passR').val();
        username = $('#userR').val();
        passconf = $('#passConf').val();
        errors=[];
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
        if(password != passconf){
            $("#passConfError").html("Passwords do not match");
        }
        
        console.log(errors.length);

        var podaciZaSlanje;
        if(errors.length==0){
             podaciZaSlanje = {
                ime: firstName,
                prezime: lastName,
                email: email,
                lozinka: password,
                username: username
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
var adminPanelErrorMessage = $("#error");
$("#answers").click(function (e) {
  showTable("answers.php");
});
// INSERT ANSWER
$(document).on("click", "#insertAnswer", function () {
  var answerName = $("#answerName").val();
  var votes = $("#votes").val();
  var surveyID = $("#surveyID").val();
  $.ajax({
    type: "POST",
    url: "models/insertAnswers.php",
    data: {
      answerNamePHP: answerName,
      votesPHP: votes,
      surveyIDPHP: surveyID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("answers.php");
        $("#success").text("Successfully inserted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("answers.php");
      $("#error").text("Insert failed. Please insert a valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
// DELETE ANSWERS
$(document).on("click", "input[name='deleteAnswer']", function (e) {
    var ID = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "models/deleteAnswers.php",
      data: {
        IDPHP: ID,
      },
      dataType: "json",
      success: function (response) {
        if (response == 1) {
          showTable("panel/answers.php");
          $("#success").text("Successfully deleted.");
          setTimeout(() => {
            $("#success").text("");
          }, 1500);
        }
      },
      error: function (error) {
        showTable("panel/answers.php");
        $("#error").text("Delete failed.");
        setTimeout(() => {
          $("#error").text("");
        }, 1500);
      },
    });
  });
  // UPDATE ANSWERS
  $(document).on("click", "input[name='updateAnswer']", function (e) {
    var answerID = $(this).attr("id");
    var answerName = $(this)
      .parent()
      .parent()
      .find("td:nth-child(2) input")
      .val();
    var votes = $(this).parent().parent().find("td:nth-child(3) input").val();
    $.ajax({
      type: "POST",
      url: "models/updateAnswers.php",
      data: {
        answerIDPHP: answerID,
        answerNamePHP: answerName,
        votesPHP: votes,
      },
      dataType: "json",
      success: function (response) {
        if (response == 1) {
          showTable("panel/answers.php");
          $("#success").text("Successfully updated.");
          setTimeout(() => {
            $("#success").text("");
          }, 1500);
        }
      },
      error: function (error) {
        showTable("answers.php");
        $("#error").text("Update failed. Please insert valid values.");
        setTimeout(() => {
          $("#error").text("");
        }, 1500);
      },
    });
  });
  $("#cars").click(function (e) {
    showTable("cars.php");
  });
  //INSERT CAR
  $(document).on("click", "#insertCar", function () {
    var carsBrandID = $("#carsBrandID").val();
    var model = $("#model").val();
    var km = $("#km").val();
    var driveID = $("#driveID").val();
    var carsBodyID = $("#carsBodyID").val();
    var topSpeed = $("#topSpeed").val();
    var kw = $("#kw").val();
    var transmissionID = $("#transmissionID").val();
    var color = $("#color").val();
    var imageID = $("#imageID").val();
    var price = $("#price").val();
    $.ajax({
      type: "POST",
      url: "models/insertCar.php",
      data: {
        carsBrandIDPHP: carsBrandID,
        modelPHP: model,
        kmPHP: km,
        driveIDPHP: driveID,
        carsBodyIDPHP: carsBodyID,
        topSpeedPHP: topSpeed,
        kwPHP: kw,
        transmissionIDPHP: transmissionID,
        colorPHP: color,
        imageIDPHP: imageID,
        pricePHP: price,
      },
      dataType: "json",
      success: function (response) {
        if (response == 1) {
          alert("Successfully inserted");
        }
      },
      error: function (error) {
        alert("Insert failed. Please insert valid values.");
      },
    });
  });
  // DELETE CAR
  $(document).on("click", "input[name='deleteCar']", function () {
    var ID = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "models/deleteCar.php",
      data: {
        IDPHP: ID,
      },
      dataType: "json",
      success: function (response) {
        alert("Deleted successfully.");
      },
      error: function (error) {
        alert("Delete failed.");
      },
    });
  });
  $("#cars_body").click(function () {
    showTable("cars_body.php");
  });
  //INSERT CARS_BODY
  $(document).on("click", "#insertCarsBody", function (e) {
    var name = $("#carsBodyName").val();
    $.ajax({
      type: "POST",
      url: "models/insertCarsBody.php",
      data: {
        namePHP: name,
      },
      dataType: "json",
      success: function (response) {
        if (response == 1) {
          showTable("cars_body.php");
          $("#success").text("Successfully inserted.");
          setTimeout(() => {
            $("#success").text("");
          }, 1500);
        }
      },
      error: function (error) {
        showTable("cars_body.php");
        $("#error").text("Insert failed. Please insert a valid values.");
        setTimeout(() => {
          $("#error").text("");
        }, 1500);
      },
    });
  });
  //DELETE CARS_BODY
  $(document).on("click", "input[name='deleteCarsBody']", function () {
    var ID = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "models/deleteCarsBody.php",
      data: {
        IDPHP: ID,
      },
      dataType: "json",
      success: function (response) {
        if (response == 1) {
          showTable("cars_body.php");
          $("#success").text("Successfully deleted.");
          setTimeout(() => {
            $("#success").text("");
          }, 1500);
        }
      },
      error: function (error) {
        showTable("cars_body.php");
        $("#error").text("Delete failed.");
        setTimeout(() => {
          $("#error").text("");
        }, 1500);
      },
    });
  });
  // UPDATE CARS_BODY
  $(document).on("click", "input[name='updateCarsBody']", function (e) {
    var carsBodyID = $(this).attr("id");
    var name = $(this).parent().parent().find("td:nth-child(2) input").val();
    $.ajax({
      type: "POST",
      url: "models/updateCarsBody.php",
      data: {
        carsBodyIDPHP: carsBodyID,
        namePHP: name,
      },
      dataType: "json",
      success: function (response) {
        if (response == 1) {
          showTable("cars_body.php");
          $("#success").text("Successfully updated.");
          setTimeout(() => {
            $("#success").text("");
          }, 1500);
        }
      },
      error: function (error) {
        showTable("cars_body.php");
        $("#error").text("Update failed. Please insert valid values.");
        setTimeout(() => {
          $("#error").text("");
        }, 1500);
      },
    });
  });
  $("#cars_brand").click(function () {
    showTable("cars_brand.php");
  });
  //INSERT CARS_BRAND
  $(document).on("click", "#insertCarsBrand", function (e) {
    var name = $("#carsBrandName").val();
    $.ajax({
      type: "POST",
      url: "models/insertCarsBrand.php",
      data: {
        namePHP: name,
      },
      dataType: "json",
      success: function (response) {
        if (response == 1) {
          showTable("cars_brand.php");
          $("#success").text("Successfully inserted.");
          setTimeout(() => {
            $("#success").text("");
          }, 1500);
        }
      },
      error: function (error) {
        showTable("cars_brand.php");
        $("#error").text("Insert failed. Please insert a valid values.");
        setTimeout(() => {
          $("#error").text("");
        }, 1500);
      },
    });
  });
  //DELETE CARS_BRAND
  $(document).on("click", "input[name='deleteCarsBrand']", function () {
    var ID = $(this).attr("id");
    $.ajax({
      type: "POST",
      url: "models/deleteCarsBrand.php",
      data: {
        IDPHP: ID,
      },
      dataType: "json",
      success: function (response) {
        if (response == 1) {
          showTable("cars_brand.php");
          $("#success").text("Successfully deleted.");
          setTimeout(() => {
            $("#success").text("");
          }, 1500);
        }
      },
      error: function (error) {
        showTable("cars_brand.php");
        $("#error").text("Delete failed.");
        setTimeout(() => {
          $("#error").text("");
        }, 1500);
      },
    });
  });
  // UPDATE CARS_BRAND
  $(document).on("click", "input[name='updateCarsBrand']", function (e) {
    var carsBrandID = $(this).attr("id");
    var name = $(this).parent().parent().find("td:nth-child(2) input").val();
    $.ajax({
      type: "POST",
      url: "models/updateCarsBrand.php",
      data: {
        carsBrandIDPHP: carsBrandID,
        namePHP: name,
      },
      dataType: "json",
      success: function (response) {
        if (response == 1) {
          showTable("cars_brand.php");
          $("#success").text("Successfully updated.");
          setTimeout(() => {
            $("#success").text("");
          }, 1500);
        }
      },
      error: function (error) {
        showTable("cars_brand.php");
        $("#error").text("Update failed. Please insert valid values.");
        setTimeout(() => {
          $("#error").text("");
        }, 1500);
      },
    });
  });
  //FUNCTIONS FOR ADMIN PANEL
function showTable(href) {
  $.ajax({
    type: "POST",
    dataType: "json",
    url: `panel/${href}`,
    success: function (response) {
      $("#table").html(response);
    },
  });
}
$("#contact").click(function () {
  showTable("contact.php");
});
//DELETE CONTACT
$(document).on("click", "input[name='deleteContact']", function () {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "models/deleteContact.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("contact.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("contact.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});

  function showTable(href) {
    $.ajax({
      type: "POST",
      dataType: "json",
      url: `panel/${href}`,
      success: function (response) {
        $("#table").html(response);
      },
    });
  }