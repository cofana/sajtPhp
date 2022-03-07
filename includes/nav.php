
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
	    <div class="container">
	      <a class="navbar-brand" href="index.php">Car <span>Platz</span></a>
	      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	        <span class="oi oi-menu"></span> Menu
	      </button>

	      <div class="collapse navbar-collapse" id="ftco-nav">
	        <ul class="navbar-nav ml-auto">
			<?php
                        try {

                            include_once("data/connection.php");
                            global $con;
                            $output = "";
                            $upit = "SELECT * FROM menu";
                            $navigacija = $con->query($upit)->fetchAll();
                            if ($con->query($upit)->rowCount() > 0 and $navigacija) {
                                foreach ($navigacija as $red) {
                                    if (!isset($_SESSION["korisnik"])) {
                                        $output .= "<li class='nav-item'><a href='$red->href' class='nav-link'>$red->title</a></li>";
                                    } else {
                                        if (!in_array($red->href, ["login.php", "register.php"]))
                                            $output .= "<li class='nav-item'><a href='$red->href' class='nav-link'>$red->title</a></li>";
                                    }
                                }
                                echo $output;
                            } else {
                                echo "Nema menija";
                            }
                        } catch (PDOException $e) {
                            echo "Greska sa serverom";
                            http_response_code(500);
                        }
                        ?>
						                        <?php
                        #var_dump($_SESSION["korisnik"]);
                        if (isset($_SESSION['korisnik']) && $_SESSION['korisnik']->role == "administrator") :
                        ?>
                            <li><a id="apLink" class="nav-link logoutbtn adminPanelBoja" href="adminPanel.php">Admin panel</a></li>
                        <?php
                        endif;
                        ?>
                        <?php
                        #var_dump($_SESSION["korisnik"]);
                        if (isset($_SESSION['korisnik'])) :
                        ?>
                            <li><a class="nav-link logoutbtn crvena" href="models/log_out.php">Logout</a></li>
                        <?php
                        endif;
                        ?>
	        </ul>
	      </div>
	    </div>
	  </nav>
