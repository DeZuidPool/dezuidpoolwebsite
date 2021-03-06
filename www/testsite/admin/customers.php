<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}


require '../php/dbcredentials.php';
require_once '../php/Customer.php';
require '../php/getCustomers.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>IJS BAR De Zuidpool - Bekijk Klanten</title>
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


     <!-- payments -->
     <section id="payments" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                              <h2>Bekijk Klanten</h2>
                         </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
					<table class="table">
    						<tr>
    							<td align="left">
    								Naam 
    							</td>
    							<td align="left">
    								Login 
    							</td>
    							<td align="left">
    								# orders
    							</td>
    							<td align="left">
    								Reset Password (to 'dezuidpool')
    							</td>
    							<td></td>
    						</tr>
    						<!--  php loop over flavors -->
    						<?php 
    						  $customers = $_SESSION["customers"];
    						  if (!empty($customers) && count($customers)>0) { // we have customers
    						      foreach ($customers as $customer) {
    						          if ($customer instanceof Customer) {
    						          $htmlCustomer = '<tr>';
    						          $htmlCustomer .= '<td>';
    						          $htmlCustomer .= '<b>'.$customer->getName().' '.$customer->getFirstName().'</b>';
    						          $htmlCustomer .= '</td>';
    						          $htmlCustomer .= '<td>';
    						          $htmlCustomer .= $customer->getLogin();
    						          $htmlCustomer .= '</td>';
    						          $htmlCustomer .= '<td>';
    						          $htmlCustomer .= $customer->getNbrorders();
    						          $htmlCustomer .= '</td>';
    						          $htmlCustomer .= '<td>';
    						          $htmlCustomer .= '<a href="addPayment.php?login='.$customer->getLogin().'">order toevoegen</a>';
    						          $htmlCustomer .= '</td>';
    						          $htmlCustomer .= '<td>';
    						          $htmlCustomer .= '<a href="resetPassword.php?login='.$customer->getLogin().'">reset password</a>';
    						          $htmlCustomer .= '</td>';
    						          $htmlCustomer .= '</tr>';
    						          echo $htmlCustomer;
    						          }
    						      }
    						  }
    						?>
    						<!-- end loop -->
    						<!-- php insert new -->
						</table>
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