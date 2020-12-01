<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}

require 'php/testinput.php';
require 'php/dbcredentials.php';

$nofaults = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // TODO formcheck
         if ($nofaults) {
            // implement saving abo's
            $nofaults = $_SESSION["nofaults"];
            if (!$nofaults) { // empty new flavor fields
                $error = $_SESSION["error"];
                echo $error;
            }
        } else {
            echo 'input problems update smaken: '.$inputError;
        }
    }
}

require 'php/getFlavors.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>

     <title>IJS BAR De Zuidpool - Beheer Smaken</title>
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

     <!-- smaken -->
     <section id="smaken" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                              <h2>Beheer Smaken</h2>
                         </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
					<table class="table">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#smaken" method="post">
    						<tr>
    							<td align="left">
    								Naam 
    							</td>
    							<td align="left">
    								Beschrijving 
    							</td>
    							<td align="left">
    								Type
    							</td>
    							<td align="left">
    								In den Toog 
    							</td>
    							<td align="left">
    								Coming Soon
    							</td>
    							<td align="left">
    								Vegan
    							</td>
    						</tr>
    						<!--  php loop over flavors -->
    						<?php 
    						  $counter=0;
    						  $flavors = $_SESSION["flavors"];
    						  if (!empty($flavors) && count($flavors)>0) { // we have flavors
    						      foreach ($flavors as $flavor) {
    						          $htmlFlavor = '<tr>';
    						          $htmlFlavor .= '<input type="hidden" name="flavorId'.$counter.'" value="'.$flavor["ID"].'" required="required">';
    						          $htmlFlavor .= '<td>';
    						          $htmlFlavor .= '<input type="text" name="flavorName'.$counter.'" value="'.$flavor["NAME"].'" required="required" size="15">';
    						          $htmlFlavor .= '</td>';
    						          $htmlFlavor .= '<td>';
    						          $htmlFlavor .= '<input type="text" name="flavorDescription'.$counter.'" value="'.$flavor["DESCRIPTION"].'" required="required" size="45">';
    						          $htmlFlavor .= '</td>';
    						          $htmlFlavor .= '<td>';
    						          $htmlFlavor .= '<select name="flavorOfType'.$counter.'" required="required" id="flavorOfType'.$counter.'">';
    						          $htmlFlavor .= '<option value="Y" ';
    						          if ($flavor["IJSTYPE"] == "Y") {
    						              $htmlFlavor .= 'selected="selected"';
    						          }
    						          $htmlFlavor .= '>ijsroom</option>';
    						          $htmlFlavor .= '<option value="S" ';
    						          if ($flavor["IJSTYPE"] == "S") {
    						              $htmlFlavor .= 'selected="selected"';
    						          }
    						          $htmlFlavor .= '>sorbet</option>';
    						          $htmlFlavor .= '<option value="P" ';
    						          if ($flavor["IJSTYPE"] == "P") {
    						              $htmlFlavor .= 'selected="selected"';
    						          }
    						          $htmlFlavor .= '>proteine</option>';
    						          $htmlFlavor .= '</td>';
    						          $htmlFlavor .= '<td align="center">';
    						          $htmlFlavor .= '<input type="checkbox" name="flavorSelling'.$counter.'" ';
    						          if ($flavor["SELLING"] == "Y") {
    						              $htmlFlavor .=' checked ';
    						          }
    						          $htmlFlavor .= '>';
    						          $htmlFlavor .= '</td>';
    						          $htmlFlavor .= '<td align="center">';
    						          $htmlFlavor .= '<input type="checkbox" name="flavorComingSoon'.$counter.'" ';
    						          if ($flavor["COMINGSOON"] == "Y") {
    						              $htmlFlavor .=' checked ';
    						          }
    						          $htmlFlavor .= '>';
    						          $htmlFlavor .= '</td>';
    						          $htmlFlavor .= '<td align="center">';
    						          $htmlFlavor .= '<input type="checkbox" name="flavorVegan'.$counter.'" ';
    						          if ($flavor["VEGAN"] == "Y") {
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
    						<input type="hidden" name="flavorCounter" value="<?php echo count($flavors) ?>">
    						<!-- php insert new -->
    						<tr>
    							<td align="right" colspan="6">
    								<input type="submit" value="Aanpassen Smaken" name="submitType" >
    							</td>
    						</tr>
    						<tr>
    						<td colspan="7"><h5>Nieuwe smaak toevoegen</h5></td>
    						</tr>
    						<tr>
    							<td align="left">
    								Naam 
    							</td>
    							<td align="left">
    								Bechrijving 
    							</td>
    							<td align="left">
    								Type
    							</td>
    							<td align="left">
    								In den toog 
    							</td>
    							<td align="left">
    								Coming Soon 
    							</td>
    							<td align="left">
    								Vegan 
    							</td>
    						</tr>
    						<tr>
    							<td align="left">
    								<input type="text" name="newName" value="<?php echo $newName; ?>" size="15"> 
    							</td>
    							<td align="left">
    								<input type="text" name="newDescription" value="<?php echo $newDescription; ?>" size="45"> 
    							</td>
    							<td align="left">
    								<select name="newOfType" id="newOfType"> 
    									<option value="" disabled selected hidden>Kies...</option>
    									<option value="Y" <?php if (isset($newOfType) && $newOfType == "Y") echo 'selected="selected"' ?>>ijsroom</option>
    									<option value="S" <?php if (isset($newOfType) && $newOfType == "S") echo 'selected="selected"' ?>>sorbet</option>
    									<option value="P" <?php if (isset($newOfType) && $newOfType == "P") echo 'selected="selected"' ?>>proteineijs</option>
    								</select>
    							</td>
    							<td align="center">
    								<input type="checkbox" name="newSelling" <?php if (isset($newSelling) && $newSelling == "Y") echo 'checked' ?>>
    							</td>
    							<td align="center">
    								<input type="checkbox" name="newComingSoon" <?php if (isset($newComingSoon) && $newComingSoon == "Y") echo 'checked' ?>>
    							</td>
    							<td align="center">
    								<input type="checkbox" name="newVegan" <?php if (isset($newVegan) && $newVegan == "Y") echo 'checked' ?>>
    							</td>
    						</tr>
    						<tr>
    							<td align="right" colspan="6">
    								<input type="submit" value="Nieuwe Smaak" name="submitType" >
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