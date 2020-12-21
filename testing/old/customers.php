<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}

require 'php/testinput.php';
require 'php/dbcredentials.php';
require_once 'php/customer.php';

$nofaults = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
//if ($_POST["submitType"]=="Aanpassen Smaken") { // update Existing flavors
        $inputError = "";
        if (empty($_POST["customerCounter"]))  {
            $nofaults = false;
            $inputError .=" no counter ";
        } else {
            $updatedCustomers = array();
            $index = $_POST["customerCounter"];
            for ($i = 0; $i < $index; $i++) {
                if (!empty($_POST["id".$i])) {
                        if (!empty($_POST["payed".$i])) {
                            $payed = "Y";
                        } else {
                            $payed = "N";
                        }
                        $id = $_POST["id".$i];
                        $updatedCustomer = new Customer();
                        $updatedCustomer->set_id($id);
                        $updatedCustomer->set_payed($payed);
                        $updatedCustomers[] = $updatedCustomer;
                    } else {
                        $nofaults=false;
                        $inputError .= " empty fields for index".$i.'\n';
                    }
            }
            $_SESSION["customers"] = $updatedCustomers;
        }
        if ($nofaults) {
            require 'php/updateCustomersPayment.php';
            $nofaults = $_SESSION["nofaults"];
            if (!$nofaults) { // empty new flavor fields
                $error = $_SESSION["error"];
                echo $error;
            }
         } else {
            echo 'input problems update customers: '.$inputError;
        }
 //   }
}

require 'php/getCustomers.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>IJS BAR De Zuidpool - Beheer Betalingen</title>
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
                    <a href="index.html" class="navbar-brand">IJS BAR de Zuidpool - Beheer Smaken</a>
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
                              <h2>Beheer Betalingen</h2>
                         </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
					<table class="table">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#payments" method="post">
    						<tr>
    							<td align="left">
    								Login 
    							</td>
    							<td align="left">
    								Naam,voornaam 
    							</td>
    							<td align="left">
    								Type levering
    							</td>
    							<td align="left">
    								Betaald? 
    							</td>
    							<td align="left">
    								Alleen sorbet
    							</td>
    							<td align="left">
    								Comments
    							</td>
    						</tr>
    						<!--  php loop over flavors -->
    						<?php 
    						  $counter=0;
    						  $customers = $_SESSION["customers"];
    						  if (!empty($customers) && count($customers)>0) { // we have customers
    						      foreach ($customers as $customer) {
    						          $htmlFlavor = '<tr>';
    						          $htmlFlavor .= '<input type="hidden" name="id'.$counter.'" value="'.$customer["ID"].'" required="required">';
    						          $htmlFlavor .= '<td>';
    						          $htmlFlavor .= $customer["LOGIN"];
    						          $htmlFlavor .= '</td>';
    						          $htmlFlavor .= '<td>';
    						          $htmlFlavor .= $customer["NAME"].','.$customer["FIRSTNAME"];
    						          $htmlFlavor .= '</td>';
    						          $htmlFlavor .= '<td>';
    						          $htmlFlavor .= $customer["DELIVERYTYPE"];
    						          $htmlFlavor .= '</td>';
    						          $htmlFlavor .= '<td align="center">';
    						          $htmlFlavor .= '<input type="checkbox" name="payed'.$counter.'" ';
    						          if ($customer["PAYED"] == "Y") {
    						              $htmlFlavor .=' checked ';
    						          }
    						          $htmlFlavor .= '>';
    						          $htmlFlavor .= '</td>';
    						          $htmlFlavor .= '<td align="center">';
    						          $htmlFlavor .= $customer["SORBETONLY"];
    						          $htmlFlavor .= '</td>';
    						          $htmlFlavor .= '<td>';
    						          $htmlFlavor .= $customer["COMMENTS"];
    						          $htmlFlavor .= '</td>';
    						          $htmlFlavor .= '</tr>';
    						          echo $htmlFlavor;
    						          $counter += 1;
    						      }
    						  }
    						?>
    						<!-- end loop -->
    						<input type="hidden" name="customerCounter" value="<?php echo count($customers) ?>">
    						<!-- php insert new -->
    						<tr>
    							<td align="right" colspan="6">
    								<input type="submit" value="Aanpassen Betalingen" name="submitType" >
    							</td>
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