<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}

require 'php/dbcredentials.php';
require 'php/displayFlavors.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>

<title>IJS BAR De Zuidpool - Smaken</title>
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
				<a href="../index.html" class="navbar-brand">IJS BAR de Zuidpool -
					Smaken</a>
			</div>

			<!-- MENU LINKS -->
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-nav-first">
					<li><a href="../index.html#home" class="smoothScroll">Home</a></li>
					<!--						 <li><a href="#home" class="smoothScroll">Top</a></li>-->
					<li><a href="../menu.html" class="smoothScroll" target="_blank">Ons
							menu</a></li>
				</ul>

			</div>

		</div>
	</section>


	<!-- HOME -->

	<section id="home" class="menu-slider"
		data-stellar-background-ratio="0.5">
		<div class="row">

			<div class="owl-carousel owl-theme">
				<div class="item menu-item-first">
					<div class="menu-caption">
						<div class="container">
							<div class="col-md-8 col-sm-12">
								<h3>Ijsjes !!!</h3>
								<h1>Lick our ijs!!!</h1>
								<a href="../menu.html#menuijsjes"
									class="section-btn btn btn-default smoothScroll"
									target="_blank">Bekijk menu</a>
							</div>
						</div>
					</div>
				</div>

				<div class="item menu-item-second">
					<div class="menu-caption">
						<div class="container">
							<div class="col-md-8 col-sm-12">
								<h3>Als je wat meer honger hebt</h3>
								<h1>Wafels, broodjes, croques</h1>
								<a href="../menu.html#menuknabbels"
									class="section-btn btn btn-default smoothScroll"
									target="_blank">Bekijk menu</a>
							</div>
						</div>
					</div>
				</div>

				<div class="item menu-item-third">
					<div class="menu-caption">
						<div class="container">
							<div class="col-md-8 col-sm-12">
								<h3>Bij een hapje hoort ook een drankje</h3>
								<h1>fris- en warme dranken, vers fruitsap, shots, cocktails,
									wijn en cava</h1>
								<a href="../menu.html#menudrinks"
									class="section-btn btn btn-default smoothScroll"
									target="_blank">Bekijk menu</a>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</section>

	<!-- types -->
	<section id="smaken" data-stellar-background-ratio="0.5">
		<div class="container">
			<div class="row">

				<div class="col-md-12 col-sm-12">
					<div align="center" section-title wow
						fadeInUp" data-wow-delay="0.1s">
						<h2>Onze Smaken</h2>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div section-title wow fadeInUp" data-wow-delay="0.1s">* = Vegan</div>
					</div>
				</div>

				<div class="col-md-6 col-sm-6">
					<div section-title wow fadeInUp" data-wow-delay="0.1s">
						<h5>In den toog</h5>
					</div>
					<table class="table">
						<!--  php loop over flavors -->
    						<?php
        $activeFlavors = $_SESSION["activeFlavors"];
        if (! empty($activeFlavors) && count($activeFlavors) > 0) { // we have active flavors
            foreach ($activeFlavors as $flavor) {
                $htmlFlavor = '<tr>';
                $htmlFlavor .= '<td style="width:30%">';
                $htmlFlavor .= $flavor["NAME"];
                if ($flavor["VEGAN"] == "Y") {
                    $htmlFlavor .= '*';
                }
                $htmlFlavor .= '</td>';
                $htmlFlavor .= '<td style="width:55%">';
                $htmlFlavor .= $flavor["DESCRIPTION"];
                $htmlFlavor .= '</td>';
                $htmlFlavor .= '<td style="width:15%">';
                if ($flavor["IJSTYPE"] == "Y") {
                    $htmlFlavor .= 'ijsroom';
                } else if ($flavor["IJSTYPE"] == "S") {
                    $htmlFlavor .= 'sorbet';
                } else {
                    $htmlFlavor .= 'proteine';
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
					<div section-title wow fadeInUp" data-wow-delay="0.1s">
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
                $htmlFlavor .= $flavor["NAME"];
                if ($flavor["VEGAN"] == "Y") {
                    $htmlFlavor .= '*';
                }
                $htmlFlavor .= '</td>';
                $htmlFlavor .= '<td style="width:55%">';
                $htmlFlavor .= $flavor["DESCRIPTION"];
                $htmlFlavor .= '</td>';
                $htmlFlavor .= '<td style="width:15%">';
                if ($flavor["IJSTYPE"] == "Y") {
                    $htmlFlavor .= 'ijsroom';
                } else if ($flavor["IJSTYPE"] == "S") {
                    $htmlFlavor .= 'sorbet';
                } else {
                    $htmlFlavor .= 'proteine';
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
					<div section-title wow fadeInUp" data-wow-delay="0.1s">
						<h5>Tijdelijk niet in den toog</h5>
					</div>
					<table class="table">
						<!--  php loop over flavors -->
    						<?php
        $otherFlavors = $_SESSION["otherFlavors"];
        if (! empty($otherFlavors) && count($otherFlavors) > 0) { // we have other flavors
            foreach ($otherFlavors as $flavor) {
                $htmlFlavor = '<tr>';
                $htmlFlavor .= '<td style="width:30%">';
                $htmlFlavor .= $flavor["NAME"];
                if ($flavor["VEGAN"] == "Y") {
                    $htmlFlavor .= '*';
                }
                $htmlFlavor .= '</td>';
                $htmlFlavor .= '<td style="width:55%">';
                $htmlFlavor .= $flavor["DESCRIPTION"];
                $htmlFlavor .= '</td>';
                $htmlFlavor .= '<td style="width:15%">';
                if ($flavor["IJSTYPE"] == "Y") {
                    $htmlFlavor .= 'ijsroom';
                } else if ($flavor["IJSTYPE"] == "S") {
                    $htmlFlavor .= 'sorbet';
                } else {
                    $htmlFlavor .= 'proteine';
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
					<div section-title wow fadeInUp" data-wow-delay="0.1s">* = Vegan</div>
				</div>
			</div>
	
	</section>

	<!-- FOOTER -->
	<footer id="footer" data-stellar-background-ratio="0.5">
		<div class="container">
			<div class="row">

				<div class="col-md-2 col-sm-4">

					<div class="wow fadeInUp copyright-text" data-wow-delay="0.8s">
						<p>
							<br>Copyright &copy; 2020 <br>Badass bv <br>
							<br>Design: <a rel="nofollow" href="http://templatemo.com"
								target="_parent">TemplateMo</a>
						</p>
					</div>
				</div>

			</div>
		</div>
	</footer>


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