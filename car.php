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
	?>


	<section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
				<div class="col-md-9 ftco-animate pb-5">
					<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Cars <i class="ion-ios-arrow-forward"></i></span></p>
					<h1 class="mb-3 bread">Choose Your Car</h1>
				</div>
			</div>
		</div>
	</section>


	<section class="ftco-section bg-light">
		<div class="container">
			<div class="row">
				<?php
				/* include_once "data/connection.php";
					global $con;
					$query = "SELECT * FROM cars c INNER JOIN cars_brand cb on c.cars_brandID = cb.cars_brandID";
					$cars = $con->query($query)->fetchAll();
					if($con->query($query)->rowCount()>0){
						foreach ($cars as $car) {
							$output="<div class='col-md-4><div class='car-wrap rounded ftco-animate'><div class='img rounded d-flex align-items-end' style='background-image: url(images/Audi_A4_Avant.jpg);'>
							</div><div class='text'>
    						<h2 class='mb-0'><a href='$car->carsID'>$car->model</a></h2>
    						<div class='d-flex mb-3'>
	    						<span class='cat'>$car->name</span>
	    						<p class='price ml-auto'>$$car->price <span>/day</span></p>
    						</div>
    						<p class='d-flex mb-0 d-block'><a href='#' class='btn btn-primary py-2 mr-1 book-btn'>Book now</a></p>
    					</div></div></div>";
							echo $output;
						}
					}
					else{
						echo "Nema nista";
					} */
				include_once("data/connection.php");
				global $con;
				$limit = 12;
				if (!isset($_GET['page'])) {
					$page = 1;
				} else {
					$page = $_GET['page'];
				}

				$query = "SELECT * FROM cars c";
				$rowCount = $con->query($query)->rowCount();
				$pageCount = ceil($rowCount / $limit);
				$start = ($page - 1) * $limit;
				$query = "SELECT *, cb.name as carName FROM cars c INNER JOIN images s on c.imageID = s.imageID  INNER JOIN cars_brand cb ON c.cars_brandID = cb.cars_brandID ORDER BY carsID LIMIT $start,$limit ";
				$result = $con->query($query)->fetchAll();
				#var_dump($result);
				if ($result) {
					$output = "";
					foreach ($result as $res) {
						$output .= "<div class='col-md-4'>";
						$output .= "<div class='car-wrap rounded ftco-animate'>";
						$output .= "<div class='img rounded d-flex align-items-end' style='background-image: url(images/$res->path);'></div>";

						$output .= "<div class='text'>";
						$output .= "<h2 class='mb-0'><a href='car-single.php'>$res->model</a></h2>";
						$output .= "<div class='d-flex mb-3'>";
						$output .= "<span class='cat'>$res->carName</span>";
						$output .= "<p class='price ml-auto'>$ $res->price <span>/day</span></p> </div>";

						$output .= "<p class='d-flex mb-0 d-block'><a href='car-single.php' class='btn btn-primary py-2 mr-1 book-btn'>Book now</a></p> </div></div></div>";
					}
					$output .= "<div class='row mt-5'><div class='col text-center'><div class='block-27'><ul>";
					for ($i = 1; $i <= $pageCount; $i++) {
						$class = $page == $i ? 'active' : "";
						$output .= "<li class='" . $class . "'><a href='car.php?&page=" . $i . "'>" . $i . "</a></li>";
					}
					$output .= "</ul></div></div></div>";
					echo $output;
				}
				?>
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