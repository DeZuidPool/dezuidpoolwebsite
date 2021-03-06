<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}

require '../php/testinput.php';
require_once '../php/Customer.php';

// define variables and set to empty values
$lastName = $firstName = $email = $password = $gsm = $communications = "";
$lastNameErr = $firstNameErr = $emailErr = $passwordErr = $gsmErr = "";

$nofaults = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["lastName"])) {
        $lastNameErr = "Naam is vereist";
        $nofaults = false;
    } else {
        $lastName = test_input($_POST["lastName"]);
    }
    if (empty($_POST["firstName"])) {
        $firstNameErr = "Voornaam is vereist";
        $nofaults = false;
    } else {
        $firstName = test_input($_POST["firstName"]);
    }
    if (empty($_POST["gsm"])) {
        $gsmErr = "Gsm nummer is vereist";
        $nofaults = false;
    } else {
        $gsm = test_input($_POST["gsm"]);
    }
    if (empty($_POST["email"])) {
        $emailErr = "Email is vereist";
        $nofaults = false;
    } else {
        $email = test_input($_POST["email"]);
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Email bevat geen emailadres";
            $nofaults = false;
        }
    }
    if (empty($_POST["password"])) {
        $passwordErr = "Paswoord is vereist";
        $nofaults = false;
    } else {
        $password = test_input($_POST["password"]);
    }
    if (empty($_POST["password2"])) {
        $password2Err = "Herhaal je paswoord";
        $nofaults = false;
    } else {
        $password2 = test_input($_POST["password2"]);
        if ($password != $password2) {
            $password2Err = "Je paswoord is niet 2 maal hetzelfde";
            $nofaults = false;
        }
    }
    if (! empty($_POST["communications"])) {
        $communications = "Y";
    } else {
        $communications = "N";
    }
    // if errors in input --> nosave
    if ($nofaults) {
        // Create Customer Object and put in session
        $customer = new Customer(null, $lastName, $firstName, $email, 0);
        $customer->setPassword(password_hash($password, PASSWORD_DEFAULT));
        $customer->setCommunications($communications);
        $_SESSION["customer"] = $customer;
        // save account to db and forward to deliveryadress.php
        require '../php/dbcredentials.php';
        require '../php/saveCustomer.php';
        $nofaults = $_SESSION["nofaults"];
        if ($nofaults) {
            header('Location: overviewCustomer.php');
        } else { // register failed
            $emailErr = $_SESSION["emailErr"];
        }
    }
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
		<?php include "../include/menusimple.html" ?>


     <!-- HOME -->
		<?php include "../include/header.html" ?>

	<!-- types -->
	<section id="bestellen" data-stellar-background-ratio="0.5">
		<div class="container">
			<div class="row">

				<div class="col-md-12 col-sm-12">
					<div class="section-title wow fadeInUp" data-wow-delay="0.1s">
						<h2>Registreer je hier en maak een ijs-abonnement aan:</h2>
						<p> Meer informatie betreft het ijs-abonnement vind je <a href="/ijsabo.html" target="_blank">hier</a>
						</p>
						<p>Vergeet niet om de juiste informatie door te geven, dan kunnen wij jouw ijsplezier garanderen.
						</p>
					</div>
					<div class="has-error" align="left">* : Verplicht veld</div>
				</div>

				<div class="col-md-9 col-sm-9">
					<h5>Registreer</h5>
						<form
							action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>#bestellen"
							method="post">
					<table class="table">
							<tr>
								<td align="left">Naam:</td>
								<td align="left"><input type="text" name="lastName"
									value="<?php echo $lastName; ?>"> <span class="has-error">* <?php echo $lastNameErr;?></span></td>
							</tr>
							<tr>
								<td align="left">Voornaam:</td>
								<td align="left"><input type="text" name="firstName"
									value="<?php echo $firstName; ?>"> <span class="has-error">* <?php echo $firstNameErr;?></span></td>
							</tr>
							<tr>
								<td align="left">GSM:</td>
								<td align="left"><input type="text" name="gsm"
									value="<?php echo $gsm; ?>"> <span class="has-error">* <?php echo $gsmErr;?></span></td>
							</tr>
							<tr>
								<td align="left">Email:</td>
								<td align="left"><input type="email" name="email"
									value="<?php echo $email; ?>"> <span class="has-error">* <?php echo $emailErr;?></span>
									<br>
								<input type="checkbox" name="communications" value="Y"
									<?php if (isset($communications) && $communications =="Y") echo "checked=\"checked\"";?>>
									Ik wens emails te ontvangen over acties of nieuwigheden</td>
							</tr>
							<tr>
								<td align="left">Paswoord: Kies een veilig paswoord!</td>
								<td align="left"><input type="password" name="password"> <span
									class="has-error">* <?php echo $passwordErr;?></span></td>
							</tr>
							<tr>
								<td align="left">Herhaal Paswoord:</td>
								<td align="left"><input type="password" name="password2"> <span
									class="has-error">* <?php echo $password2Err;?></span></td>
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
	<section id="contact" data-stellar-background-ratio="0.5">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12">
					<div class="section-title wow fadeInUp" data-wow-delay="0.1s">
						<h2>Wat doen wij met jouw gegevens?</h2>
						<p>
							Wij gebruiken jouw gegevens enkel voor De Zuidpool<br> Je
							emailadres werkt tevens als login en zullen wij enkel gebruiken,
							indien je hiervoor gekozen hebt,<br> om jou te informeren over	
						</p>					
						<ul>
							<li>De Zuidpool</li>
							<li>acties</li>
							<li>nieuwigheden</li>
						</ul>
						
						<p>Je Gsm nummer zullen wij enkel gebruiken ivm met levering(en).</p>
						<p>Je adres wordt ook enkel gebruikt voor levering(en).</p>
						<p>Onder geen beding zullen wij jouw gegevens delen met derden.</p>
					</div>
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