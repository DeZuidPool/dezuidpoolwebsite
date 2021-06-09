<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}

require '../php/testinput.php';

// define variables and set to empty values
$login = $password = "";
$loginErr = $pwdErr = "";
$registerErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["login"])) {
        $loginErr = "Login is vereist";
    } else {
        $login = test_input($_POST["login"]);
    }
    if (empty($_POST["password"])) {
        $pwdErr = "Paswoord is vereist";
    } else {
        $password = test_input($_POST["password"]);
    }
    
    // check account in db and forward to order.php with id to get data
    require "../php/dbcredentials.php";
    require "../php/loginCustomer.php";
    $customerid=$_SESSION["customerid"];
    if ($customerid == "none") {
        if ($loginErr =="" && $pwdErr == "") {
            $registerErr = "Login/Paswoord onbekend.";
        }
    } else {
        header("Location: overviewCustomer.php");
    }
}

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
     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

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
                              <h2>Beheer je gegevens</h2>
                         </div>
						<div class="has-error" align="left">
						* : Verplicht veld
						</div>
                    </div>

                    <div class="col-md-9 col-sm-9">
					<h5>Log in</h5>
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#bestellen" method="post">
					<table class="table">
    						<tr>
    							<td align="left">
    								Email: 
    							</td>
    							<td align="left">
    								<input type="email" name="login" value="<?php echo $login?>">
								<span class="has-error">* <?php echo $loginErr;?></span></td>
    						</tr>
    						<tr>
    							<td align="left">
    								Paswoord: 
    							</td>
    							<td align="left">
    								<input type="password" name="password">
								<span class="has-error">* <?php echo $pwdErr;?></span></td>
    						</tr>
    						<tr>
    							<td align="right" colspan="2">
    								<input type="submit">
    							</td>
    						</tr>
						<tr>
							<td colspan="2" align="left"><span class="has-error"><?php echo $registerErr;?></span>Nog geen account?  <a href="register.php#bestellen"><span style = "text-decoration:underline;">Registeer hier.</span></a></td>
						</tr>
						<tr>
							<td colspan="2" align="left">Wil je meer weten over het valentijn pretpakket? <a href="../valentijn.html"><span style = "text-decoration:underline;">Kijk hier.</span></a></td>
						</tr>
						<tr>
							<td colspan="2" align="left">Wil je meer weten over het ijs-abonnement? <a href="../ijsabo.html"><span style = "text-decoration:underline;">Kijk hier.</span></a></td>
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