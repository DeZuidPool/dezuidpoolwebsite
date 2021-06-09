<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}
require '../php/testinput.php';

require "../php/dbcredentials.php";
require_once "../php/Abonnement.php";
require_once '../php/Customer.php';
// getCustomer and put it on session
require "../php/getCustomer.php";
require "../php/getAbos.php";

$customer = $_SESSION["customer"];
$customerid = $customer->getId();
$lastName = $customer->getName();
$firstName = $customer->getFirstName();
$gsm = $customer->getGsm();
$email = $customer->getLogin();
$communications = $customer->getCommunications();
unset($_SESSION["customer"]);

$lastNameErr = $firstNameErr = $emailErr = $passwordErr = $gsmErr = "";
$nofaults = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["submitType"] == "Bewaar gegevens") {
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
        
        if ($nofaults) {
            $customer->setName($lastName);
            $customer->setFirstName($firstName);
            $customer->setGsm($gsm);
            $customer->setLogin($email);
            $customer->setPassword(password_hash($password, PASSWORD_DEFAULT));
            $customer->setCommunications($communications);            
            $_SESSION["customer"] = $customer;
            require '../php/updateCustomer.php';
            $nofaults = $_SESSION["nofaults"];
            if (! $nofaults) {
                $emailErr = $_SESSION["emailErr"];
            }
        }
    } else if ($_POST["submitType"] == "Nieuw abonnement") {
        
        $_SESSION["customerid"] = $customerid;
        $_SESSION["gsm"] = $gsm;
        $_SESSION["name"] = $firstName.' '.$lastName;

        header("Location: addAbo.php");
    } else if ($_POST["submitType"] == "Wijzig") {
        $_SESSION["customerid"] = $customerid;
        $_SESSION["id"] = $_POST["id"];
        
        header("Location: existingAbo.php");
    } else { 
        echo 'unknown submit : \''.$_POST["submitType"].'\'' ;
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
						<h2>Beheer hier je registratie voor je ijs-abonnement</h2>
						<p>Hier kan je je gegevens wijzigen indien nodig.</p>
					</div>
				</div>
				<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>#bestellen" method="post">

				<div class="col-md-9 col-sm-9">
					<h5>Jouw gegevens:</h5>
					<table class="table">
							<tr>
								<td align="left">Naam:</td>
								<td align="left"><input type="text" name="lastName"
									value="<?php echo $lastName; ?>"> <span class="has-error">* <?php echo $lastNameErr; ?></span></td>
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
									<br> <input type="checkbox" name="communications" value="Y"
									<?php if (isset($communications) && $communications =="Y") echo "checked=\"checked\"";?>>
									Ik wens emails te ontvangen over acties of nieuwigheden</td>
							</tr>
							<tr>
								<td align="left">Paswoord: Kies een veilig paswoord!</td>
								<td align="left"><input type="password" name="password"> <span
									class="has-error">* <?php echo $passwordErr; ?></span></td>
							</tr>
							<tr>
								<td align="left">Herhaal Paswoord:</td>
								<td align="left"><input type="password" name="password2"> <span
									class="has-error">* <?php echo $password2Err; ?></span></td>
							</tr>
							<tr>
								<td align="right" colspan="2"><input type="submit" value="Bewaar gegevens" name="submitType"></td>
							</tr>
					</table>
				</div>
				</form>
				<div class="col-md-9 col-sm-9" >
				<h5>Jouw abonnement(en):</h5>
				<table class="table">
					<tr>
    					<td align="left">
    						Abonr 
    					</td>
    					<td align="left">
    						Contact  
    					</td>
    					<td align="left">
    						Type 
    					</td>
    					<td align="left">
    						Actief? 
    					</td>
    					<td align="left">
    						per week 
    					</td>
    					<td align="left">
    						Van
    					</td>
    					<td align="left">
    						Adres
    					</td>
    					<td>
    						Wijzig
    					</td>
    				</tr>
						<?php 
						$abonnementen = $_SESSION["abonnementen"];
						if (!empty($abonnementen) && count($abonnementen)>0) {
						    foreach ($abonnementen as $abonnement) {
						        $htmlAbo = '<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'#bestellen" method="post">';
						        $htmlAbo .= '<input type="hidden" name="id" value="'.$abonnement->getId().'">';
						        $htmlAbo .= '<tr>';
						        $htmlAbo .= '<td align="left">';
						        $htmlAbo .= $abonnement->getId();
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '<td align="left">';
						        $htmlAbo .= '<span style="white-space: nowrap;">'.$abonnement->getName().'</span><br>'.$abonnement->getGsm();
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '<td align="left">';
						        $htmlAbo .= $abonnement->getDeliveryType();
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '<td align="center">';
						        $htmlAbo .= $abonnement->getPayed();
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '<td align="left">';
						        if ($abonnement->getPotspw() == "1") {
						            $htmlAbo .= "1 pot per week";
						        } else {
						            $htmlAbo .= "2 potten per week";
						        }
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '<td align="left">';
						        if ($abonnement->getFirstDelDate() != null) {
						            $htmlAbo .= $abonnement->getFirstDelDate();
						        }
						        $htmlAbo .= '</td>';
						        if ($abonnement->getDeliveryType() == "delivery") {
						            $htmlAbo .= '<td align="left">';
						            $htmlAbo .= '<span style="white-space: nowrap;">'.$abonnement->getStreet().' '.$abonnement->getNbr().'</span></br>';
						            $htmlAbo .= '<span style="white-space: nowrap;">'.$abonnement->getZipCode().' '.$abonnement->getCity().'</span>';
						            $htmlAbo .= '</td>';
						        } else {
						            $htmlAbo .= '<td>';
						            $htmlAbo .= '</td>';
						        }
						        $htmlAbo .= '<td>';
						        $htmlAbo .= '<input type="submit" value="Wijzig" name="submitType">';
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '</tr>';
						        $htmlAbo .= '</form>';
						        echo $htmlAbo;
						    }
						}
						?>
						</table>
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>#bestellen" method="post">
						<table class="table">
						<tr>
							<td colspan="8" align="right">
								<input type="submit" value="Nieuw abonnement" name="submitType">
							</td>
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
