<!DOCTYPE html>
<html lang="en">

<head>
	<?php
	session_start();
	include_once "includes/head.php";
	?>
</head>

<body>

	<?php
	include_once "includes/nav.php";

	?>

	<div class="hero-wrap ftco-degree-bg" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
		<div class="overlay"></div>
		<div class="container">
			<div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
				<div class="col-lg-8 ftco-animate">
					<div class="text w-100 text-center ">
						<h1 class="mb-4 indeksNaslov">Fast &amp; Easy Way To Rent A Car</h1>
					</div>
				</div>
				<?php
				if (!isset($_SESSION['korisnik'])) {
				?>
					<div class="col-lg-8">
						<h1 class="loginTekst">Log in</h1>
						<form action="#" class="contact-form">
							<label for="username" class="labelLogin">Username: </label>
							<div class="form-group">
								<input type="text" id="user" name="username">
							</div>
							<label for="password" class="labelLogin">Password: </label>
							<div class="form-group">
								<input type="password" id="pass" name="password">
							</div>
							<div class="form-group">
								<input type="button" value="Log in" id="loginButton">
							</div>
						</form>

					<?php
				}
					?>
					</div>
					<?php
					global $con;
					if (isset($_SESSION['korisnik'])) {
						$korisnik = $_SESSION['korisnik'];
						$output = "<h1 class='bela korisnikIme'>Hello $korisnik->firstName $korisnik->lastName</h1>";
						echo $output;
					}
					?>
			</div>


		</div>
		<div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">

			<?php
			if (isset($_SESSION["korisnik"])) {
				try {
					include_once("data/connection.php");
					include_once("functions.php");
					echo "<div class='container w-75 text-left'>";
					$username = $_SESSION["korisnik"]->username;

					$query = "SELECT voted FROM users WHERE username = '$username'";
					$glasanje = $con->query($query)->fetch();

					if ($glasanje->voted == 0) {
						// VOTED
						$query = "SELECT * FROM survey WHERE surveyID = 1";
						$result = $con->query($query)->fetch();
						echo "<p class='h5 font-weight-bold mb-3 plava'>$result->question</p> <br>";
						$query = "SELECT * FROM answers WHERE surveyID = 1";
						$result = $con->query($query)->fetchAll();
						echo "<table class='table bela'>";
						foreach ($result as $res) {
							echo ("<tr><td class='h6 plava' width='10%'>$res->answerName</td><td class='text-left'><input type='radio' value='$res->answerID' class='text-left' name='answer'></td></tr>");
						}
						echo "</table>";
						echo ("<button class='btn btn-dark' id='surveySubmit'>Submit answer</button>");
						echo ("<span id='surveyError' class='text-danger ml-5 font-weight-bold'></span>");
					} else if ($glasanje->voted == 1) {
						// RESULTS OF VOTING
						echo "<p class='h5 font-weight-bold mb-3'>Results of voting</p> <br>";
						$query = "SELECT answerName FROM answers WHERE surveyID = 1";
						$result = $con->query($query)->fetchAll();
						$percents = showPercents(1);
						echo "<table class='table'>";
						for ($i = 0; $i < count($result); $i++) {
							echo "<tr>";
							echo "<td class='h6' width='10%'>" . $result[$i]->answerName . "</td>";
							echo "<td class='results text-left'>";
							echo "<div class='bg-primary text-right font-weight-bold pr-1 rounded-right' style='width:" . $percents[$i] . "%'>" . round($percents[$i]) . "%</div>";
							echo "</td>";
							echo "</tr>";
						}
						echo "</table>";
						echo "<span class='text-danger font-weight-bold' id='surveyError'></span>";
					}
					echo "</div>";
				} catch (PDOException $e) {
					http_response_code(500);
					echo $e->getMessage();
				}
			}
			?>
		</div>
	</div>








	<?php
	include_once "includes/footer.php";
	include_once "includes/loader.php";
	include_once "includes/scripts.php";
	?>
</body>

</html>