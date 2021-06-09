<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}
require '../php/testinput.php';

// define variables and set to empty values
$street = $nbr = $zipCode = $city = $adresRemarks = $customerid = $deliveryType = "";
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
    // check distance

    if ($nofaults) {
        // save linked address in db and forward to order.php with cust_id to get data
        require '../php/dbcredentials.php';
        require '../php/saveVal.php';

        header("Location: thanks.php");
    }
}
$_SESSION["customerid"] = $customerid;

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
						<h2>Bestel een valentijn pretpakket.</h2>
						<p>Je bestelling is finaal na betaling van <b>&euro;
								28.50</b> op rekening nummer <b>BE59 7512 1050 8026</b><br>
							Vermeld bij de betaling je emailadres en het registratienr
							zodat wij de deze aan jouw account kunnen linken!
						</p>
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
							<td align="right" colspan="2"><input type="submit"></td>
						</tr>
					</table>
						</form>
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