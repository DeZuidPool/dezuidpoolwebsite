<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}


require "../php/dbcredentials.php";
require "../php/getCustomer.php";
require_once "../php/Abonnement.php";
require "../php/getAbo.php";
$customer = $_SESSION["customer"];
$abonnement = $_SESSION["abonnement"];
unset($_SESSION["customer"]);
unset($_SESSION["abonnement"]);
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
		<?php include "../include/header.html" ?>

	<!-- types -->
	<section id="bestellen" data-stellar-background-ratio="0.5">
		<div class="container">
			<div class="row">

				<div class="col-md-12 col-sm-12">
					<div class="section-title wow fadeInUp" data-wow-delay="0.1s">
						<h2>Bedankt om te registreren</h2>
						<p>
							Zodra jouw betaling van <b>&euro; 50.00</b> op rekening nummer <b>BE59
								7512 1050 8026</b> <br> ons bereikt krijg je een melding via
							SMS.<br> Je ijs-abonemment start dan de daarop volgende week.</p>
							<p>Vergeet niet om bij de betaling je <b>email</b> en de <b>identificatie van je abonnement</b> te vermelden!</p>
					</div>
				</div>

				<div class="col-md-9 col-sm-9">
					<h5>Jouw gegevens:</h5>
					<table class="table">
						<tr>
							<td align="left">Naam:</td>
							<td align="left"><?php echo $customer->getName()?></td>
						</tr>
						<tr>
							<td align="left">Voornaam:</td>
							<td align="left"><?php echo $customer->getFirstName()?></td>
						</tr>
						<tr>
							<td align="left">GSM:</td>
							<td align="left"><?php echo $customer->getGsm()?></td>
						</tr>
						<tr>
							<td align="left">Email:</td>
							<td align="left"><?php echo $customer->getLogin()?><br>
								<?php
        if ($customer->getCommunications() == "Y") {
            echo "Ik wens emails te ontvangen over acties of nieuwigheden.";
        } else {
            echo "Ik wens geen emails te ontvangen over acties of nieuwigheden.";
        }
        ?>
								</td>
						</tr>
					</table>
						<h5>Je bestelling :</h5>
					<table class="table">
						<?php 
						        $htmlAbo = '<tr>';
						        $htmlAbo .= '<td align="left">';
						        $htmlAbo .= 'Identificatie';
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '<td>';
						        $htmlAbo .= $abonnement->getId();
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '</tr>';
						        $htmlAbo .= '<tr>';
						        $htmlAbo .= '<td colspan="2"  align="left">';
						        if ($abonnement->getSorbetOnly() == "Y") {
						            $htmlAbo .= 'Je hebt gekozen om enkel sorbet te krijgen';
						        } else {
						            $htmlAbo .= 'Je hebt gekozen om zowel roomijs als sorbet te krijgen';
						        }
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '</tr>';
						        $htmlAbo .= '<tr>';
						        $htmlAbo .= '<td colspan="2" align="left">';
						        if ($abonnement->getPotspw() == "1") {
						            $htmlAbo .= 'Je hebt gekozen om 1 pot per week te krijgen';
						        } else {
						            $htmlAbo .= 'Je hebt gekozen om 2 potten per week te krijgen';
						        }
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '</tr>';
						        if ($abonnement->getComments() != "") {
						            $htmlAbo .= '<tr>';
						            $htmlAbo .= '<td align="left">';
						            $htmlAbo .= 'Opmerkingen abonnement';
						            $htmlAbo .= '</td>';
						            $htmlAbo .= '<td align="left">';
						            $htmlAbo .= $abonnement->getComments();
						            $htmlAbo .= '</td>';
						            $htmlAbo .= '</tr>';
						        }
						        if ($abonnement->getDeliveryType() == "delivery") {
						            $htmlAbo .= '<tr>';
						            $htmlAbo .= '<td colspan="2" align="left">';
						            $htmlAbo .= 'Je hebt ervoor gekozen om te laten leveren op volgend adres';
						            $htmlAbo .= '</td>';
						            $htmlAbo .= '</tr>';

						            $htmlAbo .= '<tr>';
						            $htmlAbo .= '<td align="left">Straat';
						            $htmlAbo .= '</td>';
						            $htmlAbo .= '<td align="left">';
						            $htmlAbo .= $abonnement->getStreet();
						            $htmlAbo .= '</td>';
						            $htmlAbo .= '</tr>';
						            
    						        $htmlAbo .= '<tr>';
    						        $htmlAbo .= '<td align="left">Nummer';
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '<td align="left">';
    						        $htmlAbo .= $abonnement->getNbr();
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '</tr>';
    						        
    						        $htmlAbo .= '<tr>';
    						        $htmlAbo .= '<td align="left">Postcode';
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '<td align="left">';
    						        $htmlAbo .= $abonnement->getZipCode();
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '</tr>';
    						        
    						        $htmlAbo .= '<tr>';
    						        $htmlAbo .= '<td align="left">Gemeente';
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '<td align="left">';
    						        $htmlAbo .= $abonnement->getCity();
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '</tr>';
    						        if ($abonnement->getAdresRemarks() != "") {
    						        $htmlAbo .= '<tr>';
    						        $htmlAbo .= '<td align="left">Opmerkingen adres';
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '<td align="left">';
    						        $htmlAbo .= $abonnement->getAdresRemarks();
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '</tr>';
    						        }
						        } else {
						            $htmlAbo .= '<tr>';
						            $htmlAbo .= '<td colspan="2" align="left">';
						            $htmlAbo .= 'Je hebt ervoor gekozen om te komen afhalen';
						            $htmlAbo .= '</td>';
						            $htmlAbo .= '</tr>';
						        }
						        echo $htmlAbo;
						?>
						<tr>
							<td align="center" colspan="2" ><a href="overviewCustomer.php#bestellen"><span  style = "text-decoration:underline;">Naar mijn overzicht</span></a></td>
						</tr>
					</table>
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