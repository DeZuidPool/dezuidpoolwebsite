<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}

require 'php/testinput.php';
require 'php/dbcredentials.php';
require_once 'php/Abonnement.php';
require_once 'php/Customer.php';


$nofaults = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inputError = "";
        if (empty($_POST["aboCounter"]))  {
            $nofaults = false;
            $inputError .=" no counter ";
        } else {
            $updatedAbos = array();
            $index = $_POST["aboCounter"];
            //echo 'total abos : '.$index;
            for ($i = 0; $i < $index; $i++) {
                if (!empty($_POST["id".$i])) {
                        $updatedAbo = new Abonnement();
                        if (!empty($_POST["payed".$i])) {
                            $payed = "Y";
                            if (!empty($_POST["abobegin".$i])) {
                                    $abobegin = $_POST["abobegin".$i];
                                    $updatedAbo->set_firstDelDate($abobegin);
                            } else {
                                    $updatedAbo->set_firstDelDate(null);
                            }
                        } else {
                            $payed = "N";
                        }
                        $id = $_POST["id".$i];
                        $updatedAbo->set_id($id);
                        $updatedAbo->set_payed($payed);
                        $updatedAbos[] = $updatedAbo;
                    } else {
                        $nofaults=false;
                        $inputError .= " empty fields for index".$i.'\n';
                    }
            }
            $_SESSION["updatedAbos"] = $updatedAbos;
        }
        if ($nofaults) {
            require 'php/updateAbos.php';
            $nofaults = $_SESSION["nofaults"];
            if (!$nofaults) {
                $error = $_SESSION["error"];
                echo $error;
            }
         } else {
            echo 'input problems updating abos: '.$inputError;
        }
}

require 'php/getCustomerAbos.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>IJS BAR De Zuidpool - Beheer abonnementen</title>
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
     <section class="navbar custom-navbar navbar-fixed-top" role="navigation">
          <div class="container">

               <div class="navbar-header">
                    <button class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                         <span class="icon icon-bar"></span>
                    </button>

                    <!-- lOGO TEXT HERE -->
                    <a href="index.html" class="navbar-brand">IJS BAR de Zuidpool - Beheer abonnementen</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <li><a href="index.html" class="smoothScroll">Home</a></li>
                         <li><a href="#smaken" class="smoothScroll">Top</a></li>
                    </ul>

               </div>

          </div>
     </section>

     <!-- payments -->
     <section id="payments" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                              <h2>Beheer abonnementen</h2>
                         </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#payments" method="post">
					<table class="table">
    						<tr>
    							<td align="left">
    								Login 
    							</td>
    							<td align="left">
    								AboId 
    							</td>
    							<td align="left">
    								Abocontact
    							</td>
    							<td align="left">
    								Activeer abo
    							</td>
    							<td align="left">
    								pot per week
    							</td>
    							<td align="left" >
    								Begin
    							</td>
    						</tr>
    						<!--  php loop over flavors -->
    						<?php 
    						  $counter=0;
    						  $login="";
    						  $customerAbos = $_SESSION["abonnementen"];
    						  if (!empty($customerAbos) && count($customerAbos)>0) { // we have customers
    						      foreach ($customerAbos as $customerAbo) {
    						          $htmlAbo = '<tr>';
    						          if ($login != $customerAbo["LOGIN"]) {
    						              $login = $customerAbo["LOGIN"];
    						              $htmlAbo .= '<td>';
    						              $htmlAbo .= $login;
    						              $htmlAbo .= '</td>';
    						          } else {
    						              $htmlAbo .= '<td></td>';
    						          }
    						          $htmlAbo .= '<td>';
    						          $htmlAbo .= '<input type="hidden" name="id'.$counter.'" value="'.$customerAbo["ABOID"].'" required="required">';
    						          $htmlAbo .= $customerAbo["ABOID"];
    						          $htmlAbo .= '</td>';
    						          $htmlAbo .= '<td>';
    						          $htmlAbo .= '<b>'.$customerAbo["ABONAME"].'</b>';
    						          $htmlAbo .= '</br>'.$customerAbo["STREET"];
    						          $htmlAbo .= '</br>'.$customerAbo["CITY"];
    						          $htmlAbo .= '</br>'.$customerAbo["ADRESREMARKS"];
    						          $htmlAbo .= '</td>';
    						          $htmlAbo .= '<td align="center">';
    						          $htmlAbo .= '<input type="checkbox" name="payed'.$counter.'" ';
    						          if ($customerAbo["ABOPAYED"] == "Y") {
    						              $htmlAbo .=' checked ';
    						          }
    						          $htmlAbo .= '>';
    						          $htmlAbo .= '</td>';
    						          $htmlAbo .= '<td>';
    						          $htmlAbo .= $customerAbo["POTSPW"];
    						          $htmlAbo .= '</td>';
    						          $htmlAbo .= '<td>';
    						          $htmlAbo .= '<input type="date" value="'.$customerAbo["ABOBEGIN"].'" name="abobegin'.$counter.'">';
    						          $htmlAbo .= '</td>';
    						          $htmlAbo .= '</tr>';
    						          echo $htmlAbo;
    						          $counter += 1;
    						      }
    						  }
    						?>
    						<!-- end loop -->
    						<!-- php insert new -->
    						<tr>
    							<td align="right" colspan="6">
    								<input type="submit" value="Aanpassen Betalingen" name="submitType" >
    							</td>
    						</tr>
					</table>
    						<input type="hidden" name="aboCounter" value="<?php echo count($customerAbos) ?>">
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