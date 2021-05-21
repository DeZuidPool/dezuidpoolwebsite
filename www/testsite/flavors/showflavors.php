<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}

require '../php/dbcredentials.php';
require '../php/displayFlavors.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>

<title>IJS BAR De Zuidpool - Onze actuele smaken</title>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta name="description" content="">
<meta name="keywords" content="">
<meta name="author" content="">
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1">

<link rel="stylesheet" href="../css/bootstrap.min.css">
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="../css/animate.css">
<link rel="stylesheet" href="../css/owl.carousel.css">
<link rel="stylesheet" href="../css/owl.theme.default.min.css">
<link rel="stylesheet" href="../css/magnific-popup.css">

<!-- MAIN CSS -->
<link rel="stylesheet" href="../css/templatemo-style.css">

</head>


<body>

	<!-- PRE LOADER -->
	<section class="preloader">
		<div class="spinner">

			<span class="spinner-rotate"></span>

		</div>
	</section>


	<!-- MENU -->
	<section class="navbar custom-navbar navbar-fixed-top"
		role="navigation">
		<div class="container">

			<div class="navbar-header">
				<button class="navbar-toggle" data-toggle="collapse"
					data-target=".navbar-collapse">
					<span class="icon icon-bar"></span> <span class="icon icon-bar"></span>
					<span class="icon icon-bar"></span>
				</button>

				<!-- lOGO TEXT HERE -->
				<a href="../index.html" class="navbar-brand-flavors">IJS BAR de Zuidpool -
					onze actuele smaken</a>
			</div>

			<!-- MENU LINKS -->
			<div class="collapse navbar-collapse">
				<ul class="nav-flavors navbar-nav navbar-nav-first">
					<li><a href="../index.html#home" class="smoothScroll">Home</a></li>
					<li><a href="#home" class="smoothScroll nav-flavors">Top</a></li>
					<li><a href="../menu.html" class="smoothScroll nav-flavors" target="_blank">Ons
							menu</a></li>
				</ul>

			</div>

		</div>
	</section>


	<!-- HOME -->

	<section id="home" class="menu-slider"
		data-stellar-background-ratio="0.5">
		<div class="row">


		</div>
	</section>

	<!-- types -->
	<section id="smaken" data-stellar-background-ratio="0.5">
		<div class="container">
			<div class="row">

				<div class="col-md-12 col-sm-12">
					<div align="center" class="section-title wow
						fadeInUp" data-wow-delay="0.1s">
						<h2>Onze Actuele Smaken</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="section-title wow fadeInUp" data-wow-delay="0.1s">
							Een <a href="showAllflavors.php"><span
								style="text-decoration: underline;">overzicht</span></a> van al
							onze smaken
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="section-title wow fadeInUp" data-wow-delay="0.1s"><sup>a</sup> = Alcohol, <sup>e</sup> = Eigeel, <sup>v</sup> = Vegan, <sup>g</sup> = Gluten</div>
					</div>
				</div>

				<div class="col-md-6 col-sm-6">
					<div class="section-title wow fadeInUp" data-wow-delay="0.1s">
						<h5>In den toog</h5>
					</div>
					<table class="table">
						<!--  php loop over flavors -->
    						<?php
        $flavors = $_SESSION["activeFlavors"];
        if (! empty($flavors) && count($flavors) > 0) { // we have active flavors
            foreach ($flavors as $flavor) {
                $htmlFlavor = '<tr>';
                $htmlFlavor .= '<td style="width:30%">';
                $htmlFlavor .= $flavor["NAME"].'<sup>';
                if ($flavor["ALCOHOL"] == "Y") {
                    $htmlFlavor .= 'a';
                }
                if ($flavor["EIGEEL"] == "Y") {
                    $htmlFlavor .= 'e';
                }
                if ($flavor["VEGAN"] == "Y") {
                    $htmlFlavor .= 'v';
                }
                if ($flavor["GLUTEN"] == "Y") {
                    $htmlFlavor .= 'g';
                }
                $htmlFlavor .= '</sup>';
                $htmlFlavor .= '</td>';
                $htmlFlavor .= '<td style="width:55%">';
                $htmlFlavor .= $flavor["DESCRIPTION"];
                $htmlFlavor .= '</td>';
                $htmlFlavor .= '<td style="width:15%">';
                if ($flavor["IJSTYPE"] == "Y") {
                    $htmlFlavor .= 'roomijs';
                } else if ($flavor["IJSTYPE"] == "S") {
                    $htmlFlavor .= 'sorbet';
                } else if ($flavor["IJSTYPE"] == "P"){
                    $htmlFlavor .= 'proteine';
                } else if ($flavor["IJSTYPE"] == "O"){
                    $htmlFlavor .= 'yoghurtijs';
                }
                $htmlFlavor .= '</td>';
                $htmlFlavor .= '</tr>';
                echo $htmlFlavor;
            }
        }
        ?>
    						<!-- end loop -->
					</table>
				</div>
			</div>
			<div class="row">

				<div class="col-md-6 col-sm-6">
					<div class="section-title wow fadeInUp" data-wow-delay="0.1s">
						<h5>Binnenkort in den toog</h5>
					</div>
					<table class="table">
						<!--  php loop over flavors -->
    						<?php
        $soonFlavors = $_SESSION["soonFlavors"];
        if (! empty($soonFlavors) && count($soonFlavors) > 0) { // we have coming soon flavors
            foreach ($soonFlavors as $flavor) {
                $htmlFlavor = '<tr>';
                $htmlFlavor .= '<td style="width:30%">';
                $htmlFlavor .= $flavor["NAME"].'<sup>';
                if ($flavor["ALCOHOL"] == "Y") {
                    $htmlFlavor .= 'a';
                }
                if ($flavor["EIGEEL"] == "Y") {
                    $htmlFlavor .= 'e';
                }
                if ($flavor["VEGAN"] == "Y") {
                    $htmlFlavor .= 'v';
                }
                if ($flavor["GLUTEN"] == "Y") {
                    $htmlFlavor .= 'g';
                }
                $htmlFlavor .= '</sup>';
                $htmlFlavor .= '</td>';
                $htmlFlavor .= '<td style="width:55%">';
                $htmlFlavor .= $flavor["DESCRIPTION"];
                $htmlFlavor .= '</td>';
                $htmlFlavor .= '<td style="width:15%">';
                if ($flavor["IJSTYPE"] == "Y") {
                    $htmlFlavor .= 'roomijs';
                } else if ($flavor["IJSTYPE"] == "S") {
                    $htmlFlavor .= 'sorbet';
                } else if ($flavor["IJSTYPE"] == "P") {
                    $htmlFlavor .= 'proteine';
                } else if ($flavor["IJSTYPE"] == "O") {
                    $htmlFlavor .= 'yoghurtijs';
                }
                $htmlFlavor .= '</td>';
                $htmlFlavor .= '</tr>';
                echo $htmlFlavor;
            }
        }
        ?>
    						<!-- end loop -->
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6">
						<div class="section-title wow fadeInUp" data-wow-delay="0.1s"><sup>a</sup> = Alcohol, <sup>e</sup> = Eigeel, <sup>v</sup> = Vegan, <sup>g</sup> = Gluten</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 col-sm-6">
						<div class="section-title wow fadeInUp" data-wow-delay="0.1s">Een <a href="showAllflavors.php"><span style = "text-decoration:underline;">overzicht</span></a> van al onze smaken</div>
				</div>
			</div>
		</div>
	</section>

	<!-- FOOTER -->
		<?php include "../include/footer.html" ?>


	<!-- SCRIPTS -->
	<script src="../js/jquery.js"></script>
	<script src="../js/bootstrap.min.js"></script>
	<script src="../js/jquery.stellar.min.js"></script>
	<script src="../js/wow.min.js"></script>
	<script src="../js/owl.carousel.min.js"></script>
	<script src="../js/jquery.magnific-popup.min.js"></script>
	<script src="../js/smoothscroll.js"></script>
	<script src="../js/custom.js"></script>

</body>
</html>