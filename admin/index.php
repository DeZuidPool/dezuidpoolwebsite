<!DOCTYPE html>
<html lang="en">
<head>

     <title>IJS BAR De Zuidpool - Bestellen</title>
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
<?php
// define variables and set to empty values
$login = $pwd = "";
$loginErr = $pwdErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["login"])) {
        $loginErr = "Login is vereist";
    } else {
        $login = test_input($_POST["login"]);
    }
    if (empty($_POST["pwd"])) {
        $pwdErr = "Paswoord is vereist";
    } else {
        $pwd = test_input($_POST["pwd"]);
    }
    
    // check account in db and forward to order.php with id to get data
    require "php/loginCustomer.php";
    header("Location: editAbo.php");
}

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>

<body>

     <!-- PRE LOADER -->
     <section class="preloader">
          <div class="spinner">

               <span class="spinner-rotate"></span>
               
          </div>
     </section>


     <!-- MENU -->
     <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="../index.html" class="navbar-brand">IJS BAR de Zuidpool - Bestellen</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <li><a href="../index.html#home" class="smoothScroll">Home</a></li>
<!--						 <li><a href="#home" class="smoothScroll">Top</a></li>-->
                         <li><a href="../menu.html" class="smoothScroll" target="_blank">Ons menu</a></li>
                    </ul>

               </div>

          </div>
     </section>


     <!-- HOME -->

     <section id="home" class="menu-slider" data-stellar-background-ratio="0.5">
          <div class="row">

                    <div class="owl-carousel owl-theme">
                         <div class="item menu-item-first">
                              <div class="menu-caption">
                                   <div class="container">
                                        <div class="col-md-8 col-sm-12">
                                             <h3>Ijsjes !!!</h3>
                                             <h1>Lick our ijs!!!</h1>
                                             <a href="../menu.html#menuijsjes" class="section-btn btn btn-default smoothScroll" target="_blank">Bekijk menu</a>
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
                                             <a href="../menu.html#menuknabbels" class="section-btn btn btn-default smoothScroll" target="_blank">Bekijk menu</a>
                                        </div>
                                   </div>
                              </div>
                         </div>

                         <div class="item menu-item-third">
                              <div class="menu-caption">
                                   <div class="container">
                                        <div class="col-md-8 col-sm-12">
                                             <h3>Bij een hapje hoort ook een drankje</h3>
                                             <h1>fris- en warme dranken, vers fruitsap, shots, cocktails, wijn en cava</h1>
                                             <a href="../menu.html#menudrinks" class="section-btn btn btn-default smoothScroll" target="_blank">Bekijk menu</a>
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
                              <h2>Bestelling plaatsen</h2>
                         </div>
						<div class="has-error" align="left">
						* : Verplicht veld
						</div>
                    </div>

                    <div class="col-md-9 col-sm-9">
					<h5>Log in</h5>
					<table class="table">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#bestellen" method="post">
    						<tr>
    							<td align="left">
    								Login: 
    							</td>
    							<td align="left">
    								<input type="text" name="login" value="<?php echo $login?>">
								<span class="has-error">* <?php echo $loginErr;?></span></td>
    							</td>
    						</tr>
    						<tr>
    							<td align="left">
    								Paswoord: 
    							</td>
    							<td align="left">
    								<input type="password" name="pwd">
								<span class="has-error">* <?php echo $pwdErr;?></span></td>
    							</td>
    						</tr>
    						<tr>
    							<td align="right" colspan="2">
    								<input type="submit">
    							</td>
    						</tr>
						</form>
						<tr>
							<td align="left"><a href="register.php#bestellen">Nog geen account? Registeer hier.</a></td>
						</tr>
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
                              <p><br>Copyright &copy; 2020 <br>Badass bv 
                              
                              <br><br>Design: <a rel="nofollow" href="http://templatemo.com" target="_parent">TemplateMo</a></p>
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