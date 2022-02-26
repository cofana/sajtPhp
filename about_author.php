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
    
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
          <div class="col-md-9 ftco-animate pb-5">
          	<p class="breadcrumbs"><span class="mr-2"><a href="index.php">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>About Author <i class="ion-ios-arrow-forward"></i></span></p>
            <h1 class="mb-3 bread">About Author</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-about">
			<div class="container">
				<div class="row no-gutters">
        <div class="col-md-6 p-md-5 img img-2 d-flex justify-content-center align-items-center authorSlika" style="background-image: url(images/about-author.jpg);">
					</div>
					<div class="col-md-6 wrap-about ftco-animate">
	          <div class="heading-section heading-section-white pl-md-5">
	          	<span class="subheading">About Author</span>
	            <h2 class="mb-4">Hi, my name is Filip Blagojevic</h2>

	            <p>I'm a 4th year student at ICT
              University. Im from Belgrade where i'w finished Aviation Academy
              but since i always liked computers more than aviation i persued a
              carrer in IT hoping for a better success.</p>
	          </div>
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