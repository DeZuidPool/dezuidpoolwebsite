<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}

$customerid = $_SESSION["customerid"];

// LOGIN, DELIVERYTYPE, SORBETONLY, COMMUNICATIONS, COMMENTS
$name = $firstName = $gsm = $email = $deliveryType = $sorbetOnly = $communications = $comments = "";
$street = $nbr = $zipCode = $city = $remarks = "";
$hideAdress = "style=\"display: none;\"";
require "php/dbcredentials.php";
require "php/getCustomer.php";
if ($deliveryType == "delivery") {
    $hideAdress = "";
    require "php/getAdress.php";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>

<title>IJS BAR De Zuidpool - Bestellen</title>
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
					Bestellen</a>
			</div>

			<!-- MENU LINKS -->
			<div class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-nav-first">
					<li><a href="../index.html#home" class="smoothScroll">Home</a></li>
					<li><a href="#home" class="smoothScroll">Top</a></li>
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
	<section id="bestellen" data-stellar-background-ratio="0.5">
		<div class="container">
			<div class="row">

				<div class="col-md-12 col-sm-12">
					<div class="section-title wow fadeInUp" data-wow-delay="0.1s">
						<h2>Bedankt om te registreren</h2>
						<p>
							Zodra jouw betaling van <b>&euro; 50.00</b> op rekening nummer <b>BE59
								7512 1050 8026</b> </br> ons bereikt krijg je een melding via
							SMS.</br> Je ijs-abonemment start dan de daarop volgende week.
						</p>
					</div>
				</div>

				<div class="col-md-9 col-sm-9">
					<h5>Jouw gegevens:</h5>
					<table class="table">
						<tr>
							<td align="left">Naam:</td>
							<td align="left"><?php echo $name?></td>
						</tr>
						<tr>
							<td align="left">Voornaam:</td>
							<td align="left"><?php echo $firstName?></td>
						</tr>
						<tr>
							<td align="left">GSM:</td>
							<td align="left"><?php echo $gsm?></td>
						</tr>
						<tr>
							<td align="left">Email:</td>
							<td align="left"><?php echo $email?></br>
								<?php
        if ($communications == "Y") {
            echo "Ik wens emails te ontvangen over acties of nieuwigheden.";
        } else {
            echo "Ik wens geen emails te ontvangen over acties of nieuwigheden.";
        }
        ?>
								</td>
						</tr>
						<tr>
							<td align="left">Ik heb gekozen voor:</td>
							<td align="left">
								<?php
        if ($deliveryType == "delivery") {
            echo "Levering aan huis.";
        } else {
            echo "Afhaling.";
        }
        ?>
								</br>
								<?php
        if ($sorbetOnly == "Y") {
            echo "Enkel sorbet te krijgen.";
        } else {
            echo "Zowel roomijs als sorbet te krijgen.";
        }
        ?>
								</td>
						</tr>
						<tr>
							<td align="left">Opmerkingen :</td>
							<td align="left"><?php echo $comments?></td>
						</tr>
					</table>
					<div <?php echo $hideAdress; ?>>
						<h5>Jouw adres:</h5>
						<table class="table">
							<tr>
								<td align="left">Straat:</td>
								<td align="left"><?php echo $street?></td>
							</tr>
							<tr>
								<td align="left">Nummer:</td>
								<td align="left"><?php echo $nbr?></td>
							</tr>
							<tr>
								<td align="left">Postcode:</td>
								<td align="left"><?php echo $zipCode?></td>
							</tr>
							<tr>
								<td align="left">Gemeente:</td>
								<td align="left"><?php echo $city?></td>
							</tr>
							<tr>
								<td align="left">Opmerkingen:</td>
								<td align="left"><?php echo $remarks ?></td>
							</tr>
						</table>
					</div>
				</div>
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