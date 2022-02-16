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
    
    <div class="hero-wrap ftco-degree-bg" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
          <div class="col-lg-8 ftco-animate">
          	<div class="text w-100 text-center mb-md-5 pb-md-5">
	            <h1 class="mb-4 indeksTekst">Fast &amp; Easy Way To Rent A Car</h1>
            </div>
          </div>
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
                <input type="submit" value="Log in">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <section class="ftco-section ftco-no-pt bg-light">
    	<div class="container">
    		<div class="row justify-content-center">
          <div class="col-md-12 heading-section text-center ftco-animate mb-5">
          	<span class="subheading">What we offer</span>
            <h2 class="mb-2 h2popular">Our most popular cars</h2>
          </div>
        </div>
    		<div class="row">
    			<div class="col-md-12">
    				<div class="carousel-car owl-carousel">
    					<div class="item">
    						<div class="car-wrap rounded ftco-animate">
		    					<div class="img rounded d-flex align-items-end" style="background-image: url(images/golf-7-GTI.jpg);">
		    					</div>
		    					<div class="text">
		    						<h2 class="mb-0"><a href="#">Golf 7 GTI</a></h2>
		    						<div class="d-flex mb-3">
			    						<span class="cat">Volkswagen</span>
			    						<p class="price ml-auto">$24 <span>/day</span></p>
		    						</div>
		    						<p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1 book-btn">Book now</a></p>
		    					</div>
		    				</div>
    					</div>
    					<div class="item">
    						<div class="car-wrap rounded ftco-animate">
		    					<div class="img rounded d-flex align-items-end" style="background-image: url(images/Audi_A8.jpg);">
		    					</div>
		    					<div class="text">
		    						<h2 class="mb-0"><a href="#">A8</a></h2>
		    						<div class="d-flex mb-3">
			    						<span class="cat">Audi</span>
			    						<p class="price ml-auto">$38 <span>/day</span></p>
		    						</div>
		    						<p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1 book-btn">Book now</a></p>
		    					</div>
		    				</div>
    					</div>
    					<div class="item">
    						<div class="car-wrap rounded ftco-animate">
		    					<div class="img rounded d-flex align-items-end" style="background-image: url(images/Honda_Civic_Type_R.jpg);">
		    					</div>
		    					<div class="text">
		    						<h2 class="mb-0"><a href="#">Civic Type R</a></h2>
		    						<div class="d-flex mb-3">
			    						<span class="cat">Honda</span>
			    						<p class="price ml-auto">$32 <span>/day</span></p>
		    						</div>
		    						<p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1 book-btn">Book now</a></p>
		    					</div>
		    				</div>
    					</div>
    					<div class="item">
    						<div class="car-wrap rounded ftco-animate">
		    					<div class="img rounded d-flex align-items-end" style="background-image: url(images/volkswagen_arteon.jpg);">
		    					</div>
		    					<div class="text">
		    						<h2 class="mb-0"><a href="#">Arteon</a></h2>
		    						<div class="d-flex mb-3">
			    						<span class="cat">Volkswagen</span>
			    						<p class="price ml-auto">$34 <span>/day</span></p>
		    						</div>
		    						<p class="d-flex mb-0 d-block"><a href="#" class="btn btn-primary py-2 mr-1 book-btn">Book now</a></p>
		    					</div>
		    				</div>
    					</div>
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