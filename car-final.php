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
		$id = $_GET["id"];
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
      	<div class="row justify-content-center">
      		<h1>Price for this car is: <span id="dolarSpan"><?php echo $model->price ?>&euro;/day</span></h1>
      	</div>
        <div class="row justify-content-center">
          <form class='p-5 w-50 text-center d-flex flex-column justify-content-between' action="" method="">
            <label for="beginDate" class='font-weight-bold'>Begin Date</label>
            <input type="date" name="beginDate" id="beginDate"><br>
            <label for="endDate" class='font-weight-bold'>End Date</label>
            <input type="date" id="endDate"><br>
            <label for="totalPrice" class='text-danger h4'>Total Price </label>
            <h5 class='text-center text-danger font-weight-bold' name='totalPrice' id='totalPrice'></h5>
    <!-- <?php
        // echo "<input type='hidden' data-id='$carID'>";
        // echo "<input type='hidden' data-price='$result->price'>";
    ?> -->
            <input type="button" class="btn btn-dark" id="finalRentButton" value="Rent"><br>
            <span class='mt-5 h5 text-danger font-weight-bold text-center w-100' id='errorDate'></span>
        </form>
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