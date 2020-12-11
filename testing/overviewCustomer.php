<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}
require 'php/testinput.php';

$customerid = $_SESSION["customerid"];

// LOGIN, DELIVERYTYPE, SORBETONLY, COMMUNICATIONS, COMMENTS
$lastName = $firstName = $gsm = $email = $deliveryType = $sorbetOnly = $communications = $comments = "";
$lastNameErr = $firstNameErr = $emailErr = $passwordErr = $gsmErr = $deliveryTypeErr = "";

require "php/dbcredentials.php";
require "php/getCustomer.php";
require_once "php/abonnement.php";
require "php/getAbo.php";

$nofaults = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["submitType"] == "Bewaar gegevens") {
        if (empty($_POST["lastName"])) {
            $lastNameErr = "Naam is vereist";
            $nofaults = false;
        } else {
            $lastName = test_input($_POST["name"]);
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
        if ($nofaults) {
            $_SESSION["customerid"] = $customerid;
            // require 'php/dbcredentials.php'; should not be needed
            require 'php/updateLogin.php';
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
    } else {
        echo 'unknown submit';
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
									</br> <input type="checkbox" name="communications" value="Y"
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
    						Van 
    					</td>
    					<td align="left">
    						Tot
    					</td>
    					<td align="left">
    						Adres
    					</td>
    				</tr>
						<?php 
						$abonnementen = $_SESSION["abonnementen"];
						if (!empty($abonnementen) && count($abonnementen)>0) {
						    foreach ($abonnementen as $abonnement) {
						        $htmlAbo = '<tr>';
						        $htmlAbo .= '<td align="left">';
						        $htmlAbo .= $abonnement->get_id();
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '<td align="left">';
						        $htmlAbo .= '<span style="white-space: nowrap;">'.$abonnement->get_name().'</span><br>'.$abonnement->get_gsm();
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '<td align="left">';
						        $htmlAbo .= $abonnement->get_deliveryType();
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '<td align="center">';
						        $htmlAbo .= $abonnement->get_payed();
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '<td align="left">';
						        if ($abonnement->get_firstDelDate() != null) {
						            $htmlAbo .= $abonnement->get_firstDelDate();
						        }
						        $htmlAbo .= '</td>';
						        $htmlAbo .= '<td align="left">';
						        if ($abonnement->get_lastDelDate() != null) {
						            $htmlAbo .= $abonnement->get_lastDelDate();
						        }
						        $htmlAbo .= '</td>';
						        if ($abonnement->get_deliveryType() == "delivery") {
						            $htmlAbo .= '<td align="left">';
						            $htmlAbo .= '<span style="white-space: nowrap;">'.$abonnement->get_street().' '.$abonnement->get_nbr().'</span></br>';
						            $htmlAbo .= '<span style="white-space: nowrap;">'.$abonnement->get_zipCode().' '.$abonnement->get_city().'</span>';
						            $htmlAbo .= '</td>';
						        } else {
						            $htmlAbo .= '<td>';
						            $htmlAbo .= '</td>';
						        }
						        $htmlAbo .= '</tr>';
						        echo $htmlAbo;
						    }
						}
						?>
						<tr>
							<td colspan="7" align="left">
								Maak een nieuw abonnement aan : <input type="submit" value="Nieuw abonnement" name="sumbitType">
							</td>
						</tr>
				</table>
				</div>
				</form>
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
							<br>Copyright &copy; 2020 <br>Badass bv <br> <br>Design: <a
								rel="nofollow" href="http://templatemo.com" target="_parent">TemplateMo</a>
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
