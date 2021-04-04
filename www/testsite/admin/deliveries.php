<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}

require 'php/testinput.php';
require 'php/dbcredentials.php';
require_once 'php/Delivery.php';

$nofaults = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["submitType"]=="Aanpassen Leveringen") {
        $inputError = "";
        if (empty($_POST["deliveryCounter"]))  {
            $nofaults = false;
            $inputError .=" no counter ";
        } else {
            $updatedDeliveries = array();
            $index = $_POST["deliveryCounter"];
            for ($i = 0; $i < $index; $i++) {
                if (!empty($_POST["id".$i]) && !empty($_POST["flavor1".$i])) {
                    $aboId = test_input($_POST["id".$i]);
                    $delFlavor1 = test_input($_POST["flavor1".$i]);
                    $delFlavor2 = null;
                    if (isset($_POST["flavor2".$i])) {
                        $delFlavor2 = test_input($_POST["flavor2".$i]);
                    }
                    $delDate = test_input($_POST["date".$i]);
                    $updatedDelivery = new Delivery($aboId, $delFlavor1, $delFlavor2,$delDate);
                    $updatedDeliveries[] = $updatedDelivery;
                    //echo 'added Delivery '.$aboId.$delFlavor1.$delFlavor2.$delDate;
                } 
                //else {
                //        $nofaults=false;
                //        $inputError .= " empty fields for index ".$i.'\n';
                //}
            }
            $_SESSION["updatedDeliveries"] = $updatedDeliveries;
        }
        if ($nofaults) {
            require 'php/updateDeliveries.php';
            $nofaults = $_SESSION["nofaults"];
            if (!$nofaults) { 
                $error = $_SESSION["error"];
                echo $error;
            }
         } else {
            echo 'input problems updating deliveries: '.$inputError;
        }
    } else  if (substr($_POST["submitType"],0,13) == "Afsluiten Abo") {
        $closeId = substr($_POST["submitType"], 14);
        $_SESSION["closeId"] = $closeId;
        echo '\nclosing abo '.$closeId;
        require "php/closeAbo.php";
    }
}

require 'php/getDeliveries.php';

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
                    <a href="index.html" class="navbar-brand">IJS BAR de Zuidpool - Beheer Leveringen</a>
               </div>

               <!-- MENU LINKS -->
               <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav navbar-nav-first">
                         <li><a href="index.html" class="smoothScroll">Home</a></li>
                         <li><a href="#deliveries" class="smoothScroll">Top</a></li>
                    </ul>

               </div>

          </div>
     </section>

     <!-- deliveries -->
     <section id="deliveries" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                              <h2>Beheer Leveringen</h2>
                         </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#deliveries" method="post">
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
    								Per week
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
    						  $potspw=1;
    						  if (!empty($deliveries) && count($deliveries)>0) { // we have deliveries
    						      foreach ($deliveries as $delivery) {
    						          $potspw = $delivery["POTSPW"];
    						          if ($login != $delivery["LOGIN"]) {
    						              $login = $delivery["LOGIN"];
    						          }
    						          if ($abo != $delivery["ABOID"]) {
    						              if ($abo != "") {
        						              $htmlDeliveryInput .= '<tr>';
        						              $htmlDeliveryInput .= '<td colspan="6"></td>';
        						              $htmlDeliveryInput .= '<td>';
        						              $htmlDeliveryInput .= '<input type="date" name="date'.($counter-1).'">';
        						              $htmlDeliveryInput .= '</td>';
        						              $htmlDeliveryInput .= '<td>';
        						              $htmlDeliveryInput .= '<input type="text" name="flavor1'.($counter-1).'">';
        						              if ($potspw == 2) {
        						                  $htmlDeliveryInput .= '</br><input type="text" name="flavor2'.($counter-1).'">';
        						              }
        						              $htmlDeliveryInput .= '</td>';
        						              $htmlDeliveryInput .= '</tr>';
        						              echo $htmlDeliveryInput;
        						              $htmlDeliveryInput = "";
    						              }
    						              $htmlDelivery = '<tr>';
    						              $abo = $delivery["ABOID"];
    						              $htmlDelivery .= '<input type="hidden" name="id'.$counter.'" value="'.$delivery["ABOID"].'" required="required">';
    						              $htmlDelivery .= '<td>';
    						              $htmlDelivery .= $login;
    						              $htmlDelivery .= '</td>';
    						              $htmlDelivery .= '<td>';
    						              $htmlDelivery .= $abo;
    						              $htmlDelivery .= '</br><input type="submit" value="Afsluiten Abo '.$abo.'" name="submitType" >';
    						              $htmlDelivery .= '</td>';
    						              $htmlDelivery .= '<td>';
    						              $htmlDelivery .= $delivery["CONTACT"];
    						              $htmlDelivery .= '</br>';
    						              $htmlDelivery .= $delivery['GSM'];
    						              $htmlDelivery .= '</br>';
    						              $htmlDelivery .= $delivery['STREET'];
    						              $htmlDelivery .= '</br>';
    						              $htmlDelivery .= $delivery['CITY'];
    						              if ($delivery['ADRESREMARKS'] != "") {
    						                  $htmlDelivery .= '</br>';
    						                  $htmlDelivery .= $delivery['ADRESREMARKS'];
    						              }
    						              $htmlDelivery .= '</td>';
    						              $htmlDelivery .= '<td>';
    						              $htmlDelivery .= $delivery["DELTYPE"];
    						              if ($delivery['COMMENTS'] != "") {
    						                  $htmlDelivery .= '</br>';
    						                  $htmlDelivery .= $delivery['COMMENTS'];
    						              }
    						              $htmlDelivery .= '</td>';
    						              $htmlDelivery .= '<td>';
    						              $htmlDelivery .= $potspw;
    						              $htmlDelivery .= '</td>';
    						              $htmlDelivery .= '<td>';
    						              $htmlDelivery .= $delivery["FIRSTDELDATE"];
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
    						  $htmlDeliveryInput .= '<tr>';
    						  $htmlDeliveryInput .= '<td colspan="7"></td>';
    						  $htmlDeliveryInput .= '<td>';
    						  $htmlDeliveryInput .= '<input type="text" name="flavor1"'.($counter-1).'">';
    						  if ($potspw == 2) {
    						      $htmlDeliveryInput .= '</br><input type="text" name="flavor2"'.($counter-1).'">';
    						  }
    						  $htmlDeliveryInput .= '</td>';
    						  $htmlDeliveryInput .= '</tr>';
    						  echo $htmlDeliveryInput;
    						  
    						?>
    						<!-- end loop -->
    						<tr>
    							<td align="right" colspan="8">
    								<input type="submit" value="Aanpassen Leveringen" name="submitType" >
    							</td>
    						</tr>
						</table>
    						<input type="hidden" name="deliveryCounter" value="<?php echo count($deliveries) ?>">
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