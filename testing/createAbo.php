<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}
require 'php/testinput.php';

// define variables and set to empty values
$street = $nbr = $zipCode = $city = $adresremarks = $customerid = $deliveryType = $sorbetOnly = $comments = "";
$streetErr = $nbrErr = $zipCodeErr = $cityErr = $deliveryTypeErr = "";
$customerid = $_SESSION["customerid"];
$name = $_SESSION["name"];
$gsm = $_SESSION["gsm"];
$nofaults = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
        $nameErr = "Naam contact is vereist";
        $nofaults = false;
    } else {
        $name = test_input($_POST["name"]);
    }
    if (empty($_POST["gsm"])) {
        $gsmErr = "Gsm contact is vereist";
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
            $adresremarks = test_input($_POST["adresremarks"]);
        }
    }
    $_SESSION["customerid"] = $customerid;
    
    // check distance

    if ($nofaults) {
        // save linked address in db and forward to order.php with cust_id to get data
        require 'php/dbcredentials.php';
        require 'php/saveAbo.php';

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
						<h2>Maak een ijsabonnement aan.</h2>
						<p>
							Je abonnement start de week volgend op je betaling van <b>&euro;
								50.00</b> op rekening nummer <b>BE59 7512 1050 8026</b></br>
							Vermeld bij de overschrijving het hieronder gebruikte emailadres
							zodat wij de betaling aan jouw account kunnen linken!<br> Je
							krijgt een sms-bevestiging van de start van je abonnement en een
							sms-bericht als we onderweg zijn naar jou.
						</p>
						<p>Vergeet niet om de juiste informatie door te geven, dan kunnen
							wij jouw ijsplezier garanderen.</p>
					</div>
					<div class="has-error" align="left">* : Verplicht veld</div>
				</div>

				<div class="col-md-9 col-sm-9">
					<h5>Ijsabonnement</h5>
					<table class="table">
						<form
							action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);#bestellen?>"
							method="post">
							<input type="text" name="customerid" hidden="true"
								value="<?php echo $customerid; ?>">
							<tr>
								<td align="left">Naam contact:</td>
								<td align="left"><input type="text" name="name"
									value="<?php echo $name; ?>"> <span class="has-error">* <?php echo $nameErr;?></span></td>
							</tr>
							<tr>
								<td align="left">GSM contact:</td>
								<td align="left"><input type="text" name="gsm"
									value="<?php echo $gsm; ?>"> <span class="has-error">* <?php echo $gsmErr;?></span></td>
							</tr>
						<tr>
							<td align="left">Ik ben:</td>
							<td align="left"><input type="checkbox" name="sorbetOnly"
								value="Y"
								<?php if (isset($sorbetOnly) && $sorbetOnly =="Y") echo "checked=\"checked\"";?>>
								Lactose intolerant/vegan</br></td>
						</tr>
						<tr>
							<td align="left">Opmerkingen betreft abonnement: max 512 karakters</td>
							<td align="left"><textarea name="comments" maxlength="512"
									placeholder="ik ben allergisch aan noten/chocola/..."><?php echo $comments; ?></textarea></td>
						</tr>
						<tr>
							<td align="left">Ik wens:</td>
							<td align="left" valign="top"><input type="radio"
								name="deliveryType"
								<?php if (isset($deliveryType) && $deliveryType =="takeout") echo "checked";?>
								value="takeout"> Af te halen</br> <input type="radio"
								name="deliveryType"
								<?php if (isset($deliveryType) && $deliveryType =="delivery") echo "checked";?>
								value="delivery"> Te laten leveren</br> <span class="has-error">* <?php echo $deliveryTypeErr;?></td>
						</tr>
						<tr>
							<td align="left">Straat:</td>
							<td align="left"><input type="text" name="street"
								value="<?php echo $street?>"> <span class="has-error"> <?php echo $streetErr;?></span></td>
							</td>
						</tr>
						<tr>
							<td align="left">Nummer:</td>
							<td align="left"><input type="text" name="nbr"
								value="<?php echo $nbr?>"> <span class="has-error"> <?php echo $nbrErr;?></span></td>
							</td>
						</tr>
						<tr>
							<td align="left">Postcode:</td>
							<td align="left"><input type="text" name="zipCode"
								value="<?php echo $zipCode?>"> <span class="has-error"> <?php echo $zipCodeErr;?></span></td>
							</td>
						</tr>
						<tr>
							<td align="left">Gemeente:</td>
							<td align="left"><input type="text" name="city"
								value="<?php echo $city?>"> <span class="has-error"> <?php echo $cityErr;?></span></td>
							</td>
						</tr>
						<tr>
							<td align="left">Opmerkingen betreft het adres: (max 255 characters)</td>
							<td align="left"><textarea maxlength="255" name="adresremarks"
									placeholder="bovenste bel gebruiken..."><?php echo $adresremarks ?></textarea>
							</td>
							</td>
						</tr>
						<tr>
							<td align="right" colspan="2"><input type="submit"></td>
						</tr>
						</form>
					</table>
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