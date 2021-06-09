<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}

$customerid = $_SESSION["customerid"];

$name = $firstName = $gsm = $email = $communications = "";
require "../php/dbcredentials.php";
require "../php/getCustomer.php";
require_once "../php/Valentijn.php";
require "../php/getVals.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>

<title>IJS BAR De Zuidpool - Valentijn Pretpakket</title>
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
							Zodra jouw betaling van <b>&euro; 28.50</b> op rekening nummer <b>BE59
								7512 1050 8026</b> <br> ons bereikt krijg je een melding via
							SMS.</p>
							<p>Vergeet niet om bij de betaling je <b>email</b> en de <b>identificatie van je pakket</b> te vermelden!</p>
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
							<td align="left"><?php echo $email?><br>
								<?php
        if ($communications == "Y") {
            echo "Ik wens emails te ontvangen over acties of nieuwigheden.";
        } else {
            echo "Ik wens geen emails te ontvangen over acties of nieuwigheden.";
        }
        ?>
								</td>
						</tr>
					</table>
										<table class="table">
						<h5>Jouw pakket(ten)</h5>
						<?php 
						$valentijns = $_SESSION["valentijns"];
						if (!empty($valentijns) && count($valentijns)>0) {
						    foreach ($valentijns as $valentijn) {
						        $htmlAbo = '<tr>';
						        $htmlAbo .= '<td align="left">';
						        $htmlAbo .= 'Identificatie';
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '<td>';
						        $htmlAbo .= $valentijn->get_id();
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '</tr>';
						        if ($valentijn->get_deliveryType() == "delivery") {
						            $htmlAbo .= '<tr>';
						            $htmlAbo .= '<td colspan="2" align="left">';
						            $htmlAbo .= 'Je hebt ervoor gekozen om te laten leveren op volgend adres';
						            $htmlAbo .= '</td>';
						            $htmlAbo .= '</tr>';

						            $htmlAbo .= '<tr>';
						            $htmlAbo .= '<td align="left">Straat';
						            $htmlAbo .= '</td>';
						            $htmlAbo .= '<td align="left">';
						            $htmlAbo .= $valentijn->get_street();
						            $htmlAbo .= '</td>';
						            $htmlAbo .= '</tr>';
						            
    						        $htmlAbo .= '<tr>';
    						        $htmlAbo .= '<td align="left">Nummer';
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '<td align="left">';
    						        $htmlAbo .= $valentijn->get_nbr();
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '</tr>';
    						        
    						        $htmlAbo .= '<tr>';
    						        $htmlAbo .= '<td align="left">Postcode';
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '<td align="left">';
    						        $htmlAbo .= $valentijn->get_zipCode();
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '</tr>';
    						        
    						        $htmlAbo .= '<tr>';
    						        $htmlAbo .= '<td align="left">Gemeente';
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '<td align="left">';
    						        $htmlAbo .= $valentijn->get_city();
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '</tr>';
    						        if ($valentijn->get_adresRemarks() != "") {
    						        $htmlAbo .= '<tr>';
    						        $htmlAbo .= '<td align="left">Opmerkingen adres';
    						        $htmlAbo .= '</td>';
    						        $htmlAbo .= '<td align="left">';
    						        $htmlAbo .= $valentijn->get_adresRemarks();
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
						    }
						}
						?>
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