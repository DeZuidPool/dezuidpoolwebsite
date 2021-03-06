<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}

require '../php/testinput.php';
require '../php/dbcredentials.php';
require_once '../php/Valentijn.php';


$nofaults = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inputError = "";
        if (empty($_POST["valCounter"]))  {
            $nofaults = false;
            $inputError .=" no counter ";
        } else {
            $updatedVals = array();
            $index = $_POST["valCounter"];
            //echo 'total abos : '.$index;
            for ($i = 0; $i < $index; $i++) {
                if (!empty($_POST["id".$i])) {
                        $updatedVal = new Valentijn();
                        if (!empty($_POST["payed".$i])) {
                            $payed = "Y";
                        } else {
                            $payed = "N";
                        }
                        $id = $_POST["id".$i];
                        $updatedVal->set_id($id);
                        $updatedVal->set_payed($payed);
                        $updatedVals[] = $updatedVal;
                    } else {
                        $nofaults=false;
                        $inputError .= " empty fields for index".$i.'\n';
                    }
            }
            $_SESSION["updatedVals"] = $updatedVals;
        }
        if ($nofaults) {
            require '../php/updateVals.php';
            $nofaults = $_SESSION["nofaults"];
            if (!$nofaults) { // empty new flavor fields
                $error = $_SESSION["error"];
                echo $error;
            }
         } else {
            echo 'input problems updating vals: '.$inputError;
        }
}

require '../php/getCustomerVals.php';

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
		<?php include "../include/menusimple.html" ?>


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
    								ValId 
    							</td>
    							<td align="left">
    								Valcontact
    							</td>
    							<td align="left">
    								Betaald? 
    							</td>
    						</tr>
    						<!--  php loop over valentijns -->
    						<?php 
    						  $counter=0;
    						  $customerVals = $_SESSION["valentijns"];
    						  if (!empty($customerVals) && count($customerVals)>0) { // we have customers
    						      foreach ($customerVals as $customerVal) {
    						          $htmlFlavor = '<tr>';
    						          $htmlFlavor .= '<input type="hidden" name="id'.$counter.'" value="'.$customerVal["ABOID"].'" required="required">';
    						          $htmlFlavor .= '<td>';
    						          $htmlFlavor .= $customerVal["LOGIN"];
    						          $htmlFlavor .= '</td>';
    						          $htmlFlavor .= '<td>';
    						          $htmlFlavor .= $customerVal["ABOID"];
    						          $htmlFlavor .= '</td>';
    						          $htmlFlavor .= '<td>';
    						          $htmlFlavor .= $customerVal["ABONAME"];
    						          $htmlFlavor .= '</td>';
    						          $htmlFlavor .= '<td align="center">';
    						          $htmlFlavor .= '<input type="checkbox" name="payed'.$counter.'" ';
    						          if ($customerVal["ABOPAYED"] == "Y") {
    						              $htmlFlavor .=' checked ';
    						          }
    						          $htmlFlavor .= '>';
    						          $htmlFlavor .= '</td>';
    						          $htmlFlavor .= '</tr>';
    						          echo $htmlFlavor;
    						          $counter += 1;
    						      }
    						  }
    						?>
    						<!-- end loop -->
    						<input type="hidden" name="valCounter" value="<?php echo count($customerVals) ?>">
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