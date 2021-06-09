<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}

require '../php/testinput.php';
require '../php/dbcredentials.php';
require_once '../php/Delivery.php';
require '../php/getAllDeliveries.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>IJS BAR De Zuidpool - Leveringen ijsabo</title>
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


     <!-- deliveries -->
     <section id="deliveries" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                              <h2>Alle Leveringen</h2>
                         </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
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
    								Type
    							</td>
    							<td align="left">
    								Potten
    							</td>
    							<td align="left">
    								Begin
    							</td>
    							<td align="left">
    								Levering
    							</td>
    							<td align="left">
    								Smaken
    							</td>
    						</tr>
    						<!--  php loop over deliveries -->
    						<?php 
    						  $counter=0;
    						  $login = $abo = "";
    						  $deliveries = $_SESSION["deliveries"];
    						  $potspw=2;
    						  if (!empty($deliveries) && count($deliveries)>0) { // we have deliveries
    						      foreach ($deliveries as $delivery) {
    						          if ($login != $delivery["LOGIN"]) {
    						              $login = $delivery["LOGIN"];
    						          }
    						          if ($abo != $delivery["ABOID"]) {
    						              $htmlDelivery = '<tr>';
    						              $potspw = $delivery["POTSPW"];
    						              $abo = $delivery["ABOID"];
    						              $htmlDelivery .= '<td>';
    						              $htmlDelivery .= $login;
    						              $htmlDelivery .= '</td>';
    						              $htmlDelivery .= '<td>';
    						              $htmlDelivery .= $abo;
    						              $htmlDelivery .= '</td>';
    						              $htmlDelivery .= '<td>';
    						              $htmlDelivery .= '<b>'.$delivery["CONTACT"].'</b>';
    						              $htmlDelivery .= '</br>';
    						              $htmlDelivery .= $delivery['GSM'];
    						              $htmlDelivery .= '</br>';
    						              $htmlDelivery .= $delivery['STREET'];
    						              $htmlDelivery .= '</br>';
    						              $htmlDelivery .= $delivery['CITY'];
    						              if ($delivery['ADRESREMARKS'] != "") {
    						                  $htmlDelivery .= '</br>';
    						                  $htmlDelivery .= '<b>'.$delivery['ADRESREMARKS'].'</b>';
    						              }
    						              $htmlDelivery .= '</td>';
    						              $htmlDelivery .= '<td>';
    						              $htmlDelivery .= $delivery["DELTYPE"];
    						              if ($delivery['COMMENTS'] != "") {
    						                  $htmlDelivery .= '</br>';
    						                  $htmlDelivery .= '<b>'.$delivery['COMMENTS'].'</b>';
    						              }
    						              $htmlDelivery .= '</td>';
    						              $htmlDelivery .= '<td>';
    						              $htmlDelivery .= $potspw;
    						              $htmlDelivery .= '</td>';
    						              $htmlDelivery .= '<td>';
    						              $htmlDelivery .= '<span style="white-space:nowrap;">'.$delivery["FIRSTDELDATE"].'</span>';
    						              $htmlDelivery .= '</td>';
    						          } else {
    						              $htmlDelivery = '<tr>';
    						              $htmlDelivery .= '<td>';
    						              $htmlDelivery .= '</td>';
    						              $htmlDelivery .= '<td>';
    						              $htmlDelivery .= '</td>';
    						              $htmlDelivery .= '<td>';
    						              $htmlDelivery .= '</td>';
    						              $htmlDelivery .= '<td>';
    						              $htmlDelivery .= '</td>';
    						              $htmlDelivery .= '<td>';
    						              $htmlDelivery .= '</td>';
    						              $htmlDelivery .= '<td>';
    						              $htmlDelivery .= '</td>';
    						          }
    						          $htmlDelivery .= '<td>';
    						          $htmlDelivery .= $delivery["WEEKDATE"];
    						          $htmlDelivery .= '</td>';
    						          $htmlDelivery .= '<td>';
    						          $htmlDelivery .= $delivery["FLAVOR1"];
    						          if ($delivery["FLAVOR2"] != null) {
    						              $htmlDelivery .= '</br>'.$delivery["FLAVOR2"];
    						          }
    						          $htmlDelivery .= '</td>';
    						          $htmlDelivery .= '</tr>';
    						          echo $htmlDelivery;
    						          $counter += 1;
    						      }
    						  }
    						  echo $htmlDeliveryInput;
    						  
    						?>
    						<!-- end loop -->
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