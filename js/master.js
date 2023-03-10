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
    const ERROR_SURVEY = "Please vote to see results";
    const ONE_DAY = 24 * 60 * 60 * 1000;
    
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
                imePHP: firstName,
                prezimePHP: lastName,
                emailPHP: email,
                lozinkaPHP: password,
                usernamePHP: username
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

$("#contactButton").click(function () {
  
  const ERROR_MESSAGE = "Message needs to be at least 15 characters long";
  errors = [];
  var firstName = $("#firstName").val();
  var lastName = $("#lastName").val();
  var email = $("#email").val();
  var message = $("#message");
  
  var firstNameError = $("#firstNameError");
  var lastNameError = $("#lastNameError");
  var emailError = $("#emailError");
  var messageError = $("#messageError");
  firstNameError.text("");
  lastNameError.text("");
  emailError.text("");
  messageError.text("");
  check(firstName,regImePrezime,IME_ERROR,firstNameError);
  check(lastName, regImePrezime,PREZIME_ERROR, lastNameError);
  check(email, regEmail, EMAIL_ERROR, emailError);
  
  if (message.val().length < 15) {
    errors.push(ERROR_MESSAGE);
    messageError.text(ERROR_MESSAGE);
  }
  console.log(errors.length);
  if (errors.length == 0) {
    $.ajax({
      method: "POST",
      url: "models/sendContact.php",
      data: {
        firstNamePHP: firstName,
        lastNamePHP: lastName,
        emailPHP: email,
        messagePHP: message.val(),
      },
      dataType: "json",
      success: function (response) {
        console.log(response);
        $("#response").text(
          "Message was succesfully sent."
        );
      },
    });
  }
});

$(document).on("click", "button[name='finalRent']", function (e) {
  errors = [];
  var carID = $(this).attr("id");
  $.ajax({
    type: "GET",
    url: "models/rentCar.php",
    data: {
      carIDPHP: carID,
    },
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response == true) {
        alert("Please log in to rent a car.");
        location.replace("index.php");
      } else if (response == false) {
        location.replace(`car-final.php?id=${carID}`);
      }
    },
    error: function (err) {
      console.log(err);
    },
  });
});
$("#endDate").change(function (e) {
  var currentDate = new Date();
  var price = $("input[data-price]").attr("data-price");
  var beginDate = new Date(document.getElementById("beginDate").value);
  var endDate = new Date(document.getElementById("endDate").value);
  var daysRent = Math.round(Math.abs((endDate - beginDate) / ONE_DAY));
  var totalPriceSpan = $("#totalPrice");
  console.log(beginDate);
  if (beginDate < currentDate || endDate < currentDate) {
    errors.push("ERROR DATE");
    totalPriceSpan.text("");
    $("#errorDate").text("Please select a date in future");
  }
  if (beginDate == "Invalid Date" || endDate == "Invalid Date") {
    totalPriceSpan.text("");
    $("#errorDate").text("Please select a date in future");
  } else {
    totalPriceSpan.html(daysRent * price + " &euro; / " + daysRent + " days");
  }
});
$("#finalRentButton").click(function (e) {
  errors = [];
  var currentDate = new Date();
  var carID = $("input[data-id]").attr("data-id");
  var price = $("input[data-price]").attr("data-price");
  var totalPriceSpan = $("#totalPrice");
  var beginDate = new Date(document.getElementById("beginDate").value);
  var endDate = new Date(document.getElementById("endDate").value);
  if (beginDate == "Invalid Date" || endDate == "Invalid Date") {
    errors.push("ERROR DATE");
    totalPriceSpan.text("");
    $("#errorDate").text("Please select a date");
  }
  if (beginDate < currentDate || endDate < currentDate) {
    errors.push("ERROR DATE");
    totalPriceSpan.text("");
    $("#errorDate").text("Please select a date in future");
  }
  console.log(errors.length);
  if (errors.length == 0) {
    //TOTAL PRICE SHOW
    var daysRent = Math.round(Math.abs((endDate - beginDate) / ONE_DAY));
    totalPriceSpan.html(daysRent * price + " &euro; / " + daysRent + " days");
    var totalPrice = daysRent * price;
    $.ajax({
      type: "POST",
      url: "models/rentCarFinal.php",
      data: {
        carIDPHP: carID,
        beginDatePHP: beginDate.toISOString().split("T")[0],
        endDatePHP: endDate.toISOString().split("T")[0],
        totalPricePHP: totalPrice,
      },
      dataType: "json",
      success: function (response) {
        alert(
          `You rented successfully for the ${daysRent} days and the total price of ${totalPrice} ???`
        );
        location.replace("index.php");
      },
    });
  }
});
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
        if (response) {
          showTable("answers.php");
          $("#success").text("Successfully deleted.");
          setTimeout(() => {
            $("#success").text("");
          }, 1500);
        }
      },
      error: function (error) {
        console.log(error);
        showTable("answers.php");
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
    var fuelID = $("#fuelID").val();
    var seatsID = $("#seatsID").val();
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
        fuelIDPHP: fuelID,
        seatsIDPHP: seatsID,
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
          showTable("cars.php");
          $("#success").text("Successfully inserted.");
          setTimeout(() => {
            $("#success").text("");
          }, 1500);
        }
      },
      error: function (error) {
        showTable("cars.php");
        $("#error").text("Insert failed. Please insert a valid values.");
        setTimeout(() => {
          $("#error").text("");
        }, 1500);
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
        if (response == 1) {
          showTable("cars.php");
          $("#success").text("Successfully deleted.");
          setTimeout(() => {
            $("#success").text("");
          }, 1500);
        }
      },
      error: function (error) {
        showTable("cars.php");
        $("#error").text("Delete failed.");
        setTimeout(() => {
          $("#error").text("");
        }, 1500);
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
$("#drive").click(function () {
  showTable("drive.php");
});
//INSERT DRIVE
$(document).on("click", "#insertDrive", function (e) {
  var name = $("#driveName").val();
  $.ajax({
    type: "POST",
    url: "models/insertDrive.php",
    data: {
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("drive.php");
        $("#success").text("Successfully inserted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("drive.php");
      $("#error").text("Insert failed. Please insert a valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//DELETE DRIVE
$(document).on("click", "input[name='deleteDrive']", function () {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "models/deleteDrive.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("drive.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("drive.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
// UPDATE DRIVE
$(document).on("click", "input[name='updateDrive']", function (e) {
  var driveID = $(this).attr("id");
  var name = $(this).parent().parent().find("td:nth-child(2) input").val();
  $.ajax({
    type: "POST",
    url: "models/updateDrive.php",
    data: {
      driveIDPHP: driveID,
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("drive.php");
        $("#success").text("Successfully updated.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("drive.php");
      $("#error").text("Update failed. Please insert valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
$("#fuel").click(function () {
  showTable("fuel.php");
});
//INSERT FUEL
$(document).on("click", "#insertFuel", function (e) {
  var name = $("#fuelName").val();
  $.ajax({
    type: "POST",
    url: "models/insertFuel.php",
    data: {
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("fuel.php");
        $("#success").text("Successfully inserted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("fuel.php");
      $("#error").text("Insert failed. Please insert a valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//DELETE FUEL
$(document).on("click", "input[name='deleteFuel']", function () {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "models/deleteFuel.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("fuel.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("fuel.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
// UPDATE DRIVE
$(document).on("click", "input[name='updateFuel']", function (e) {
  var fuelID = $(this).attr("id");
  var name = $(this).parent().parent().find("td:nth-child(2) input").val();
  $.ajax({
    type: "POST",
    url: "models/updateFuel.php",
    data: {
      fuelIDPHP: fuelID,
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("fuel.php");
        $("#success").text("Successfully updated.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("fuel.php");
      $("#error").text("Update failed. Please insert valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
$("#images").click(function (e) {
  showTable("images.php");
});
//DELETE IMAGE
$(document).on("click", "input[name='deleteImage']", function (e) {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "models/deleteImage.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == true) {
        showTable("images.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("images.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//INSERT IMAGE
$(document).on("click", "#insertImage", function (e) {
  var path = $("#image").val();
  $.ajax({
    type: "POST",
    url: "models/insertImage.php",
    data: {
      pathPHP: path,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("images.php");
        $("#success").text("Successfully inserted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("images.php");
      $("#error").text("Insert failed. Please insert a valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
})
$("#menu").click(function (e) {
  showTable("menu.php");
});
//INSERT MENU
$(document).on("click", "#insertMenu", function () {
  var href = $("#href").val();
  var title = $("#title").val();
  $.ajax({
    type: "POST",
    url: "models/insertMenu.php",
    data: {
      hrefPHP: href,
      titlePHP: title,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("menu.php");
        $("#success").text("Successfully inserted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("menu.php");
      $("#error").text("Insert failed. Please insert a valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//DELETE MENU
$(document).on("click", "input[name='deleteMenu']", function (e) {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "models/deleteMenu.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("menu.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("menu.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//UPDATE MENU
$(document).on("click", "input[name='updateMenu']", function (e) {
  var menuID = $(this).attr("id");
  var href = $(this).parent().parent().find("td:nth-child(2) input").val();
  var title = $(this).parent().parent().find("td:nth-child(3) input").val();
  $.ajax({
    type: "POST",
    url: "models/updateMenu.php",
    data: {
      menuIDPHP: menuID,
      hrefPHP: href,
      titlePHP: title,
    },
    dataType: "json",
    success: function (response) {
      if (response) {
        showTable("menu.php");
        $("#success").text("Successfully updated.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("menu.php");
      $("#error").text("Update failed. Please insert valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
$("#roles").click(function () {
  showTable("roles.php");
});
//INSERT ROLES
$(document).on("click", "#insertRole", function (e) {
  var name = $("#role").val();
  $.ajax({
    type: "POST",
    url: "models/insertRole.php",
    data: {
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("roles.php");
        $("#success").text("Successfully inserted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("roles.php");
      $("#error").text("Insert failed. Please insert a valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//DELETE ROLE
$(document).on("click", "input[name='deleteRole']", function () {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "models/deleteRole.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("roles.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("roles.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
$("#seats").click(function (e) {
  showTable("seats.php");
});
//DELETE SEATS
$(document).on("click", "input[name='deleteSeats']", function (e) {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "models/deleteSeats.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("seats.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("seats.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//INSERT SEATS
$(document).on("click", "#insertSeats", function (e) {
  var number = $("#seat").val();
  $.ajax({
    type: "POST",
    url: "models/insertSeats.php",
    data: {
      numberPHP: number,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("seats.php");
        $("#success").text("Successfully inserted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("seats.php");
      $("#error").text("Insert failed. Please insert a valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
})
$("#survey").click(function () {
  showTable("survey.php");
});
//INSERT SURVEY
$(document).on("click", "#insertSurvey", function (e) {
  var name = $("#question").val();
  $.ajax({
    type: "POST",
    url: "models/insertSurvey.php",
    data: {
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("survey.php");
        $("#success").text("Successfully inserted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("survey.php");
      $("#error").text("Insert failed. Please insert a valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//DELETE SURVEY
$(document).on("click", "input[name='deleteSurvey']", function () {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "models/deleteSurvey.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("survey.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("survey.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//UPDATE SURVEY
$(document).on("click", "input[name='updateSurvey']", function (e) {
  var surveyID = $(this).attr("id");
  var name = $(this).parent().parent().find("td:nth-child(2) input").val();
  $.ajax({
    type: "POST",
    url: "models/updateSurvey.php",
    data: {
      surveyIDPHP: surveyID,
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("survey.php");
        $("#success").text("Successfully updated.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("survey.php");
      $("#error").text("Update failed. Please insert valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
$("#transmission").click(function () {
  showTable("transmission.php");
});
//INSERT TRANSMISSION
$(document).on("click", "#insertTransmission", function (e) {
  var name = $("#transmissionName").val();
  $.ajax({
    type: "POST",
    url: "models/insertTransmission.php",
    data: {
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("transmission.php");
        $("#success").text("Successfully inserted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("transmission.php");
      $("#error").text("Insert failed. Please insert a valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//DELETE TRANSMISSION
$(document).on("click", "input[name='deleteTransmission']", function () {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "models/deleteTransmission.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("transmission.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("transmission.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
//UPDATE TRANSMISSION
$(document).on("click", "input[name='updateTransmission']", function (e) {
  var transmissionID = $(this).attr("id");
  var name = $(this).parent().parent().find("td:nth-child(2) input").val();
  $.ajax({
    type: "POST",
    url: "models/updateTransmission.php",
    data: {
      transmissionIDPHP: transmissionID,
      namePHP: name,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("transmission.php");
        $("#success").text("Successfully updated.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("transmission.php");
      $("#error").text("Update failed. Please insert valid values.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
$("#users_cars").click(function (e) {
  showTable("users_cars.php");
});
//DELETE USERS_CARS
$(document).on("click", "input[name='deleteUsersCars']", function () {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "models/deleteUsersCars.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("users_cars.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("users_cars.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});
$("#users").click(function (e) {
  showTable("users.php");
});
//DELETE USER
$(document).on("click", "input[name='deleteUser']", function (e) {
  var ID = $(this).attr("id");
  $.ajax({
    type: "POST",
    url: "models/deleteUser.php",
    data: {
      IDPHP: ID,
    },
    dataType: "json",
    success: function (response) {
      if (response == 1) {
        showTable("users.php");
        $("#success").text("Successfully deleted.");
        setTimeout(() => {
          $("#success").text("");
        }, 1500);
      }
    },
    error: function (error) {
      showTable("users.php");
      $("#error").text("Delete failed.");
      setTimeout(() => {
        $("#error").text("");
      }, 1500);
    },
  });
});

$("#surveySubmit").on("click", function (e) {
  e.preventDefault();
  console.log("click");
  errors = [];
  var answerID = $("input[name='answer']:checked").val();
  var surveyError = $("#surveyError");
  surveyError.text("");
  if (!answerID) {
    errors.push(ERROR_SURVEY);
    surveyError.text(ERROR_SURVEY);
  }
  if (errors.length == 0) {
    $.ajax({
      type: "POST",
      url: "models/logicSurvey.php",
      data: {
        answerIDPHP: answerID,
      },
      dataType: "json",
      success: function (response) {
        location.reload();
      },
    });
  }
});
$(document).on("blur", "#search", function () {
  setTimeout(() => {
    results.style.display = "none";
  }, 2000);
});
$(document).on("input", "#search", function () {
  var results = document.getElementById("results");
  var value = $(this).val();
  $.ajax({
    type: "POST",
    url: "models/search.php",
    data: { valuePHP: value },
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response == 0) {
        results.style.display = "flex";
        results.innerText = "No results";
      } else {
        results.innerHTML = "";
        for (let i = 0; i < response.length; i++) {
          results.style.display = "flex";
          results.innerHTML += `<div class="searchDiv"><a href='car-single.php?id=${response[i]["carsID"]}' class='nav-link font-weight-bold text-center'><img class='search-img' src='images/${response[i]["path"]}'/> ${response[i]["car_brandName"]} ${response[i]["model"]}</a></div>`;
        }
      }
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
})