<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}
require '../php/testinput.php';

// define variables and set to empty values
$street = $nbr = $zipCode = $city = $adresRemarks = $customerid = $deliveryType = $sorbetOnly = $potspw = $comments = "";
$streetErr = $nbrErr = $zipCodeErr = $cityErr = $deliveryTypeErr = "";
$customerid = $_SESSION["customerid"];
$name = $_SESSION["nameCust"];
$gsm = $_SESSION["gsmCust"];
$nofaults = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Naam contact is vereist";
        $nofaults = false;
    } else {
        $name = test_input($_POST["name"]);
    }
    if (empty($_POST["gsm"])) {
        $gsmCustErr = "Gsm contact is vereist";
        $nofaults = false;
    } else {
        $gsm = test_input($_POST["gsm"]);
    }
    if (empty($_POST["deliveryType"])) {
        $deliveryTypeErr = "Kies voor leveren of afhalen aub";
        $nofaults = false;
    } else {
        $deliveryType = test_input($_POST["deliveryType"]);
    }
    if (! empty($_POST["sorbetOnly"])) {
        $sorbetOnly = "Y";
    } else {
        $sorbetOnly = "N";
    }
    $potspw = test_input($_POST["potspw"]);
    if (! empty($_POST["comments"])) {
        $comments = test_input($_POST["comments"]);
    }
    if ($deliveryType == "delivery") { // only adress for delivery
        if (empty($_POST["street"])) {
            $streetErr = "Straat is vereist";
            $nofaults = false;
        } else {
            $street = test_input($_POST["street"]);
        }
        if (empty($_POST["nbr"])) {
            $nbrErr = "nummer is vereist";
            $nofaults = false;
        } else {
            $nbr = test_input($_POST["nbr"]);
        }
        if (empty($_POST["zipCode"])) {
            $zipCodeErr = "Postcode is vereist";
            $nofaults = false;
        } else {
            $zipCode = test_input($_POST["zipCode"]);
        }
        if (empty($_POST["city"])) {
            $cityErr = "Gemeente is vereist";
            $nofaults = false;
        } else {
            $city = test_input($_POST["city"]);
        }
        if (! empty($_POST["adresremarks"])) {
            $adresRemarks = test_input($_POST["adresremarks"]);
        }
    }
    $_SESSION["customerid"] = $customerid;
    
    // check distance

    if ($nofaults) {
        require '../php/dbcredentials.php';
        require '../php/saveAbo.php';

        header("Location: thanks.php");
    }
}
$_SESSION["customerid"] = $customerid;

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
					<!--						 <li><a href="#home" class="smoothScroll">Top</a></li>-->
					<li><a href="../menu.html" class="smoothScroll" target="_blank">Ons
							menu</a></li>
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
						<h2>Maak een ijs-abonnement aan.</h2>
						<p>Je abonnement start de week volgend op je betaling van <b>&euro;
								50.00</b> op rekening nummer <b>BE59 7512 1050 8026</b><br>
							Vermeld bij de betaling je emailadres en het abonnementsnr
							zodat wij de deze aan jouw abonnement kunnen linken!<br> Je
							krijgt een sms-bevestiging van de start van je abonnement en een
							sms-bericht als we onderweg zijn naar jou.
						</p>
						<p>Vergeet niet om de juiste informatie door te geven, dan kunnen
							wij jouw ijsplezier garanderen.</p>
					</div>
					<div class="has-error" align="left">* : Verplicht veld</div>
				</div>

				<div class="col-md-9 col-sm-9">
					<h5>Ijs-abonnement</h5>
						<form
							action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);#bestellen?>"
							method="post">
							<input type="text" name="customerid" hidden="true"
								value="<?php echo $customerid; ?>">
					<table class="table">
							<tr>
								<td align="left">Naam contact:</td>
								<td align="left"><input type="text" name="name"
									value="<?php echo $name; ?>"> <span class="has-error">* <?php echo $nameErr;?></span></td>
							</tr>
							<tr>
								<td align="left">GSM contact:</td>
								<td align="left"><input type="text" name="gsm"
									value="<?php echo $gsm; ?>"> <span class="has-error">* <?php echo $gsmCustErr;?></span></td>
							</tr>
						<tr>
							<td align="left">Ik ben:</td>
							<td align="left"><input type="checkbox" name="sorbetOnly"
								value="Y"
								<?php if (isset($sorbetOnly) && $sorbetOnly =="Y") echo "checked=\"checked\"";?>>
								Lactose intolerant/vegan<br></td>
						</tr>
						<tr>
							<td align="left">Opmerkingen betreft abonnement: max 512 karakters</td>
							<td align="left"><textarea name="comments" maxlength="512"
									placeholder="ik ben allergisch aan noten/chocola/..."><?php echo $comments; ?></textarea></td>
						</tr>
						<tr>
							<td align="left">Ik wens:</td>
							<td align="left" valign="top">
							<select name="potspw">
								<option value="2" <?php if (isset($potspw) && $potspw =="2") echo 'selected="selected"';?>>2</option>
								<option value="1" <?php if (isset($potspw) && $potspw =="1") echo 'selected="selected"';?>>1</option>
							</select> pot(ten) per week
						</tr>
						<tr>
							<td></td>
							<td align="left" valign="top"><input type="radio"
								name="deliveryType"
								<?php if (isset($deliveryType) && $deliveryType =="takeout") echo "checked";?>
								value="takeout"> Af te halen<br> <input type="radio"
								name="deliveryType"
								<?php if (isset($deliveryType) && $deliveryType =="delivery") echo "checked";?>
								value="delivery"> Te laten leveren<br> <span class="has-error">* <?php echo $deliveryTypeErr;?></span></td>
						</tr>
						<tr>
							<td align="left">Straat:</td>
							<td align="left"><input type="text" name="street"
								value="<?php echo $street?>"> <span class="has-error"> <?php echo $streetErr;?></span></td>
						</tr>
						<tr>
							<td align="left">Nummer:</td>
							<td align="left"><input type="text" name="nbr"
								value="<?php echo $nbr?>"> <span class="has-error"> <?php echo $nbrErr;?></span></td>
						</tr>
						<tr>
							<td align="left">Postcode:</td>
							<td align="left"><input type="text" name="zipCode"
								value="<?php echo $zipCode?>"> <span class="has-error"> <?php echo $zipCodeErr;?></span></td>
						</tr>
						<tr>
							<td align="left">Gemeente:</td>
							<td align="left"><input type="text" name="city"
								value="<?php echo $city?>"> <span class="has-error"> <?php echo $cityErr;?></span></td>
						</tr>
						<tr>
							<td align="left">Opmerkingen betreft het adres: (max 255 characters)</td>
							<td align="left"><textarea maxlength="255" name="adresremarks"
									placeholder="bovenste bel gebruiken..."><?php echo $adresRemarks ?></textarea>
							</td>
						</tr>
						<tr>
							<td align="left"><a href="overviewCustomer.php#bestellen">Terug naar mijn overzicht</a></td>
							<td align="right"><input type="submit" value="Maak abonnement"></td>
						</tr>
					</table>
						</form>
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