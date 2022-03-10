<html>
<?php
session_start();
if (isset($_SESSION['korisnik'])) {
    $korisnik = $_SESSION['korisnik'];
    if ($korisnik->role != "administrator") {
        header("Location: index.php");
    } else {
        include_once("includes/head.php");
              
?>
<body>
    <?php
        include_once("includes/nav.php");
    ?>
    <div class="hero-wrap" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
        <div class="container-fluid min-vh-100 max-width-100">
            <div class="row">
                <div class="col-lg-12 p-2 d-flex justify-content-around pnlMargina">
                    <button id='answers' class='font-weight-bold btn bg-light text-dark'>answers</button>
                    <button id='cars' class='font-weight-bold btn bg-light text-dark'>cars</button>
                    <button id='cars_body' class='font-weight-bold btn bg-light text-dark'>cars_body</button>
                    <button id='cars_brand' class='font-weight-bold btn bg-light text-dark'>cars_brand</button>
                    <button id='contact' class='font-weight-bold btn bg-light text-dark'>contact</button>
                    <button id='drive' class='font-weight-bold btn bg-light text-dark'>drive</button>
                    <button id='fuel' class='font-weight-bold btn bg-light text-dark'>fuel</button>
                    <button id='images'class='font-weight-bold btn bg-light text-dark'>images</button>
                    <button id='menu' class='font-weight-bold btn bg-light text-dark'>menu</button>
                    <button id='roles' class='font-weight-bold btn bg-light text-dark'>roles</button>
                    <button id='seats' class='font-weight-bold btn bg-light text-dark'>seats</button>
                    <button id='survey' class='font-weight-bold btn bg-light text-dark'>survey</button>
                    <button id='transmission' class='font-weight-bold btn bg-light text-dark'>transmission</button>
                    <button id='users' class='font-weight-bold btn bg-light text-dark'>users</button>
                    <button id='users_cars' class='font-weight-bold btn bg-light text-dark'>users_cars</button>
                    
                </div>
                <div class="col-lg-11 center-div">
                    <table id='table' class='table tableAdminPanel'>
                    </table>
                    <h5 class='text-success' id='success'></h5>
                    <h5 class='text-danger' id='error'></h5>
                </div>
            </div>
        </div>
    </div>




<?php
    include_once("includes/footer.php");
    include_once("includes/scripts.php");
    }
}
?>
</body>
</html>