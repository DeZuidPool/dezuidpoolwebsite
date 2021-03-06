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
$abo = $_SESSION["abonnement"];
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
		<?php include "../include/menusimple.html" ?>


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
						        $htmlAbo .= $abo->getId();
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '</tr>';
						        $htmlAbo .= '<tr>';
						        $htmlAbo .= '<td colspan="2"  align="left">';
						        if ($abo->getSorbetOnly() == "Y") {
						            $htmlAbo .= 'Je hebt gekozen om enkel sorbet te krijgen';
						        } else {
						            $htmlAbo .= 'Je hebt gekozen om zowel roomijs als sorbet te krijgen';
						        }
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '</tr>';
						        $htmlAbo .= '<tr>';
						        $htmlAbo .= '<td colspan="2" align="left">';
						        if ($abo->getPotspw() == "1") {
						            $htmlAbo .= 'Je hebt gekozen om 1 pot per week te krijgen';
						        } else {
						            $htmlAbo .= 'Je hebt gekozen om 2 potten per week te krijgen';
						        }
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '</tr>';
						        if ($abo->getComments() != "") {
						            $htmlAbo .= '<tr>';
						            $htmlAbo .= '<td align="left">';
						            $htmlAbo .= 'Opmerkingen abonnement';
						            $htmlAbo .= '</td>';
						            $htmlAbo .= '<td align="left">';
						            $htmlAbo .= $abo->getComments();
						            $htmlAbo .= '</td>';
						            $htmlAbo .= '</tr>';
						        }
						        if ($abo->getDeliveryType() == "delivery") {
						            $htmlAbo .= '<tr>';
						            $htmlAbo .= '<td colspan="2" align="left">';
						            $htmlAbo .= 'Je hebt ervoor gekozen om te laten leveren op volgend adres';
						            $htmlAbo .= '</td>';
						            $htmlAbo .= '</tr>';

						            $htmlAbo .= '<tr>';
						            $htmlAbo .= '<td align="left">Straat';
						            $htmlAbo .= '</td>';
						            $htmlAbo .= '<td align="left">';
						            $htmlAbo .= $abo->getStreet();
						            $htmlAbo .= '</td>';
						            $htmlAbo .= '</tr>';
						            
    						        $htmlAbo .= '<tr>';
    						        $htmlAbo .= '<td align="left">Nummer';
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '<td align="left">';
    						        $htmlAbo .= $abo->getNbr();
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '</tr>';
    						        
    						        $htmlAbo .= '<tr>';
    						        $htmlAbo .= '<td align="left">Postcode';
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '<td align="left">';
    						        $htmlAbo .= $abo->getZipCode();
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '</tr>';
    						        
    						        $htmlAbo .= '<tr>';
    						        $htmlAbo .= '<td align="left">Gemeente';
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '<td align="left">';
    						        $htmlAbo .= $abo->getCity();
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '</tr>';
    						        if ($abo->getAdresRemarks() != "") {
    						        $htmlAbo .= '<tr>';
    						        $htmlAbo .= '<td align="left">Opmerkingen adres';
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '<td align="left">';
    						        $htmlAbo .= $abo->getAdresRemarks();
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