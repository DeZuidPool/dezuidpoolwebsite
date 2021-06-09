<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}
require '../php/testinput.php';

$customerid = $_SESSION["customerid"];

// LOGIN, DELIVERYTYPE, SORBETONLY, COMMUNICATIONS, COMMENTS
$lastName = $firstName = $gsmCust = $email = $communications = "";
$lastNameErr = $firstNameErr = $emailErr = $passwordErr = $gsmCustErr = "";

require "../php/dbcredentials.php";
require_once "../php/Valentijn.php";
require "../php/getCustomer.php";
require "../php/getVals.php";

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
        if (empty($_POST["gsmCust"])) {
            $gsmCustErr = "Gsm nummer is vereist";
            $nofaults = false;
        } else {
            $gsmCust = test_input($_POST["gsmCust"]);
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
        if ($nofaults) {
            $_SESSION["customerid"] = $customerid;
            require '../php/updateCustomer.php';
            $nofaults = $_SESSION["nofaults"];
            if (! $nofaults) {
                $emailErr = $_SESSION["emailErr"];
            }
        }
    } else if ($_POST["submitType"] == "Nieuw pakket") {
        
        $_SESSION["customerid"] = $customerid;
        $_SESSION["gsm"] = $gsmCust;
        $_SESSION["name"] = $firstName.' '.$lastName;

        header("Location: addVal.php");
    } else if ($_POST["submitType"] == "Wijzig") {
        $_SESSION["customerid"] = $customerid;
        $_SESSION["id"] = $_POST["id"];
        
        header("Location: existingVal.php");
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
						<h2>Beheer hier je registratie voor je valentijn pretpakket</h2>
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
								<td align="left"><input type="text" name="gsmCust"
									value="<?php echo $gsmCust; ?>"> <span class="has-error">* <?php echo $gsmCustErr;?></span></td>
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
				<h5>Jouw pakket(ten):</h5>
				<table class="table">
					<tr>
    					<td align="left">
    						Registratienr 
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
    						Adres
    					</td>
    					<td>
    						Wijzig
    					</td>
    				</tr>
						<?php 
						$valentijns = $_SESSION["valentijns"];
						if (!empty($valentijns) && count($valentijns)>0) {
						    foreach ($valentijns as $valentijn) {
						        $htmlAbo = '<form action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'#bestellen" method="post">';
						        $htmlAbo .= '<input type="hidden" name="id" value="'.$valentijn->get_id().'">';
						        $htmlAbo .= '<tr>';
						        $htmlAbo .= '<td align="left">';
						        $htmlAbo .= $valentijn->get_id();
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '<td align="left">';
						        $htmlAbo .= '<span style="white-space: nowrap;">'.$valentijn->get_name().'</span><br>'.$valentijn->get_gsm();
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '<td align="left">';
						        $htmlAbo .= $valentijn->get_deliveryType();
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '<td align="center">';
						        $htmlAbo .= $valentijn->get_payed();
						        $htmlAbo .= '</td>';
						        if ($valentijn->get_deliveryType() == "delivery") {
						            $htmlAbo .= '<td align="left">';
						            $htmlAbo .= '<span style="white-space: nowrap;">'.$valentijn->get_street().' '.$valentijn->get_nbr().'</span></br>';
						            $htmlAbo .= '<span style="white-space: nowrap;">'.$valentijn->get_zipCode().' '.$valentijn->get_city().'</span>';
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
								<input type="submit" value="Nieuw pakket" name="submitType">
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
