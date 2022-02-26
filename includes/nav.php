<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">Car <span>Platz</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
	          <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
            <li class="nav-item"><a href="register.php" class="nav-link">Register</a></li>
	          <li class="nav-item"><a href="car.php" class="nav-link">Cars</a></li>
	          <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
            <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
			<li class="nav-item"><a href="about_author.php" class="nav-link">About Author</a></li>
			<?php
				if(isset($_SESSION['korisnik'])):
			?>
			<li class="nav-item"><a href="../models/log_out.php" class="nav-link">Log out</a></li>
			<?php
				endif;
			?>
	        </ul>
	      </div>
	    </div>
	  </nav>