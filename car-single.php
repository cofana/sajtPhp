<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    include_once "includes/head.php";
    ?>
</head>
  <body>
    
  <?php
    include_once "includes/nav.php";
	include_once "data/connection.php";
  ?>
    

    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Car details <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">Car Details</h1>
          </div>
        </div>
      </div>
    </section>
		
	<?php

		global $con;
		$id = +$_GET["id"];
		
		$queryForImage = "SELECT * FROM cars c INNER JOIN images i ON c.imageID = i.imageID WHERE carsID = $id";
		$image = $con->query($queryForImage)->fetch();
		$queryForModel = "SELECT * FROM cars where carsID = $id";
		$model = $con->query($queryForModel)->fetch();
		$queryForBrand = "SELECT * FROM cars c INNER JOIN cars_brand cb ON c.cars_brandID = cb.cars_brandID WHERE carsID = $id";
		$brand = $con->query($queryForBrand)->fetch();
		$queryForTransmission = "SELECT * FROM cars c INNER JOIN transmission t ON c.transmissionID = t.transmissionID WHERE carsID = $id";
		$transmission = $con->query($queryForTransmission)->fetch();
		$queryForFuel = "SELECT * FROM cars c INNER JOIN fuel f ON c.fuelID = f.fuelID WHERE carsID = $id";
		$fuel = $con->query($queryForFuel)->fetch();
		$queryForBody = "SELECT * FROM cars c INNER JOIN cars_body cab ON c.cars_bodyID = cab.cars_bodyID WHERE carsID = $id";
		$body = $con->query($queryForBody)->fetch();
		$queryForDrive = "SELECT * FROM cars c INNER JOIN drive d ON c.driveID = d.driveID WHERE carsID = $id";
		$drive = $con->query($queryForDrive)->fetch();


	?>
	<section class="ftco-section ftco-car-details">
      <div class="container">
      	<div class="row justify-content-center">
      		<div class="col-md-12">
      			<div class="car-details">
      				<div class="img rounded" style="background-image: url(images/<?php echo $image->path; ?>);"></div> <!-- ucitavanje za sliku -->
      				<div class="text text-center">
      					<span class="subheading"><?php echo $brand->name ?></span>
      					<h2><?php echo $model->model ?></h2>
      				</div>
      			</div>
      		</div>
      	</div>
      	<div class="row">
      		<div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
              	<div class="d-flex mb-3 align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><img id="car-mileage-icon" src="images/mileage.png"/></div>
	              	<div class="text">
		                <h3 class="heading mb-0 pl-3">
		                	Mileage
		                	<span><?php echo $model->km ?> km</span>
		                </h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
              	<div class="d-flex mb-3 align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><img id="car-transmission-icon" src="images/transmission.png"/></div>
	              	<div class="text">
		                <h3 class="heading mb-0 pl-3">
		                	Transmission
		                	<span><?php echo $transmission->name ?></span>
		                </h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
          
          <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
              	<div class="d-flex mb-3 align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><img id="top-speed-icon" src="images/speedometer.png"/></div>
	              	<div class="text">
		                <h3 class="heading mb-0 pl-3">
		                	Top Speed
		                	<span><?php echo $model->top_speed ?> km/h</span>
		                </h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
          <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
              	<div class="d-flex mb-3 align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><img id="car-fuel-icon" src="images/fuel.png"/></div>
	              	<div class="text">
		                <h3 class="heading mb-0 pl-3">
		                	Fuel
		                	<span><?php echo $fuel->name ?></span>
		                </h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
      	</div>
		<div class="row">
		<div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
              	<div class="d-flex mb-3 align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><img id="car-body-icon" src="images/chassis.png"/></div>
	              	<div class="text">
		                <h3 class="heading mb-0 pl-3">
		                	Car Body
		                	<span><?php echo $body->name ?></span>
		                </h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
		  <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
              	<div class="d-flex mb-3 align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><img id="car-drive-icon" src="images/awd_drive.png"/></div>
	              	<div class="text">
		                <h3 class="heading mb-0 pl-3">
		                	Drive
		                	<span><?php echo $drive->name ?></span>
		                </h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
		  <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
              	<div class="d-flex mb-3 align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><img id="car-kilowats-icon" src="images/kw.png"/></div>
	              	<div class="text">
		                <h3 class="heading mb-0 pl-3">
		                	KW
		                	<span><?php echo $model->kw ?></span>
		                </h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
		  <div class="col-md d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services">
              <div class="media-body py-md-4">
              	<div class="d-flex mb-3 align-items-center">
	              	<div class="icon d-flex align-items-center justify-content-center"><img id="car-seat-icon" src="images/seat.png"/></div>
	              	<div class="text">
		                <h3 class="heading mb-0 pl-3">
		                	Seats
		                	<span><?php echo $model->seatsNumber ?></span>
		                </h3>
	                </div>
                </div>
              </div>
            </div>      
          </div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col text-center justify-content-center">
				
					<a href='car-final.php?id=<?php echo $id?>' class='btn btn-primary py-2 mr-1 book-btn dugmeKupi'>Book now</a>
				</div>
			</div>
		</div>
    </section>

    
    <?php
      include_once "includes/footer.php";
      include_once "includes/loader.php";
      include_once "includes/scripts.php";
    ?>     
  </body>
</html>