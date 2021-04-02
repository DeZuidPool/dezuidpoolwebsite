<?php
// Start the session
if (! isset($_SESSION)) {
    session_start();
}

require '../php/testinput.php';
require '../php/dbcredentials.php';
require_once '../php/Flavor.php';

$newName = $newDescription = $newOfType = $newSelling = $newComingSoon = $newVegan = $newAlcohol = $newEigeel = $newGluten = "";

$nofaults = true;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["submitType"]=="Nieuwe Smaak") { // new Flavor entered
        if (!empty($_POST["newName"]) 
            && !empty($_POST["newDescription"])  
            && !empty($_POST["newOfType"])) {
            $newName = test_input($_POST["newName"]);
            $newDescription = test_input($_POST["newDescription"]);
            $newOfType = test_input($_POST["newOfType"]);
            if (!empty($_POST["newSelling"])) {
                $newSelling = "Y";
            } else {
                $newSelling = "N";
            }
            if (!empty($_POST["newComingSoon"])) {
                $newComingSoon = "Y";
            } else {
                $newComingSoon = "N";
            }
            if (!empty($_POST["newVegan"])) {
                $newVegan = "Y";
            } else {
                $newVegan = "N";
            }
            if (!empty($_POST["newAlcohol"])) {
                $newAlcohol = "Y";
            } else {
                $newAlcohol = "N";
            }
            if (!empty($_POST["newEigeel"])) {
                $newEigeel = "Y";
            } else {
                $newEigeel = "N";
            }
            if (!empty($_POST["newGluten"])) {
                $newGluten = "Y";
            } else {
                $newGluten = "N";
            }
            
       } else {
           $nofaults=false;
       }
       if ($nofaults) {
           require 'php/saveFlavor.php';
           $nofaults = $_SESSION["nofaults"];
           if ($nofaults) { // empty new flavor fields
               $newName = $newDescription = $newOfType = $newSelling = $newComingSoon = $newVegan = $newAlcohol = $newEigeel = $newGluten = "";
           } else {
               $error = $_SESSION["nofaults"];
               echo $error;
           }
       } else {
           echo 'input problems nieuwe smaak';
       }
    } else if ($_POST["submitType"]=="Aanpassen Smaken") { // update Existing flavors
        $inputError = "";
        if (empty($_POST["flavorCounter"]))  {
            $nofaults = false;
            $inputError .=" no counter ";
        } else {
            $updatedFlavors = array();
            $index = $_POST["flavorCounter"];
            for ($i = 0; $i < $index; $i++) {
                if (!empty($_POST["flavorName".$i])
                    && !empty($_POST["flavorDescription".$i])
                    && !empty($_POST["flavorOfType".$i])) {
                        $name = test_input($_POST["flavorName".$i]);
                        $description = test_input($_POST["flavorDescription".$i]);
                        $ofType = test_input($_POST["flavorOfType".$i]);
                        if (!empty($_POST["flavorSelling".$i])) {
                            $selling = "Y";
                        } else {
                            $selling = "N";
                        }
                        if (!empty($_POST["flavorComingSoon".$i])) {
                            $comingSoon = "Y";
                        } else {
                            $comingSoon = "N";
                        }
                        if (!empty($_POST["flavorAlcohol".$i])) {
                            $alcohol = "Y";
                        } else {
                            $alcohol = "N";
                        }
                        if (!empty($_POST["flavorEigeel".$i])) {
                            $eigeel = "Y";
                        } else {
                            $eigeel = "N";
                        }
                        if (!empty($_POST["flavorVegan".$i])) {
                            $vegan = "Y";
                        } else {
                            $vegan = "N";
                        }
                        if (!empty($_POST["flavorGluten".$i])) {
                            $gluten = "Y";
                        } else {
                            $gluten = "N";
                        }
                        $id = $_POST["flavorId".$i];
                        $updatedFlavor = new Flavor($name,$description,$ofType,$selling,$comingSoon,$vegan,$alcohol,$eigeel,$gluten);
                        $updatedFlavor->set_id($id);
                        $updatedFlavors[] = $updatedFlavor;
                    } else {
                        $nofaults=false;
                        $inputError .= " empty fields for index".$i.'\n';
                    }
            }
            $_SESSION["flavors"] = $updatedFlavors;
        }
        if ($nofaults) {
            require 'php/updateFlavors.php';
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

     <!-- flavors -->
     <section id="flavors" data-stellar-background-ratio="0.5">
          <div class="container">
               <div class="row">

                    <div class="col-md-12 col-sm-12">
                         <div class="section-title wow fadeInUp" data-wow-delay="0.1s">
                              <h2>Beheer Smaken</h2>
                         </div>
                    </div>

                    <div class="col-md-12 col-sm-12">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>#flavors" method="post">
					<table class="table">
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
    								Alcohol 
    							</td>
    							<td align="left">
    								Eigeel 
    							</td>
    							<td align="left">
    								Vegan 
    							</td>
    							<td align="left">
    								Gluten 
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
    						          $htmlFlavor .= '>roomijs</option>';
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
    						          $htmlFlavor .= '<option value="O" ';
    						          if ($flavor["IJSTYPE"] == "O") {
    						              $htmlFlavor .= 'selected="selected"';
    						          }
    						          $htmlFlavor .= '>yoghurtijs</option>';
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
    						          $htmlFlavor .= '<input type="checkbox" name="flavorAlcohol'.$counter.'" ';
    						          if ($flavor["ALCOHOL"] == "Y") {
    						              $htmlFlavor .=' checked ';
    						          }
    						          $htmlFlavor .= '>';
    						          $htmlFlavor .= '</td>';
    						          $htmlFlavor .= '<td align="center">';
    						          $htmlFlavor .= '<input type="checkbox" name="flavorEigeel'.$counter.'" ';
    						          if ($flavor["EIGEEL"] == "Y") {
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
    						          $htmlFlavor .= '<td align="center">';
    						          $htmlFlavor .= '<input type="checkbox" name="flavorGluten'.$counter.'" ';
    						          if ($flavor["GLUTEN"] == "Y") {
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
    								Alcohol 
    							</td>
    							<td align="left">
    								Eigeel 
    							</td>
    							<td align="left">
    								Vegan 
    							</td>
    							<td align="left">
    								Gluten 
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
    									<option value="" disabled selected hidden="true">Kies...</option>
    									<option value="Y" <?php if (isset($newOfType) && $newOfType == "Y") echo 'selected="selected"' ?>>roomijs</option>
    									<option value="S" <?php if (isset($newOfType) && $newOfType == "S") echo 'selected="selected"' ?>>sorbet</option>
    									<option value="P" <?php if (isset($newOfType) && $newOfType == "P") echo 'selected="selected"' ?>>proteineijs</option>
    									<option value="O" <?php if (isset($newOfType) && $newOfType == "O") echo 'selected="selected"' ?>>yoghurtijs</option>
    								</select>
    							</td>
    							<td align="center">
    								<input type="checkbox" name="newSelling" <?php if (isset($newSelling) && $newSelling == "Y") echo 'checked' ?>>
    							</td>
    							<td align="center">
    								<input type="checkbox" name="newComingSoon" <?php if (isset($newComingSoon) && $newComingSoon == "Y") echo 'checked' ?>>
    							</td>
    							<td align="center">
    								<input type="checkbox" name="newAlcohol" <?php if (isset($newAlcohol) && $newAlcohol == "Y") echo 'checked' ?>>
    							</td>
    							<td align="center">
    								<input type="checkbox" name="newEigeel" <?php if (isset($newEigeel) && $newEigeel == "Y") echo 'checked' ?>>
    							</td>
    							<td align="center">
    								<input type="checkbox" name="newVegan" <?php if (isset($newVegan) && $newVegan == "Y") echo 'checked' ?>>
    							</td>
    							<td align="center">
    								<input type="checkbox" name="newGluten" <?php if (isset($newGluten) && $newGluten == "Y") echo 'checked' ?>>
    							</td>
    						</tr>
    						<tr>
    							<td align="right" colspan="6">
    								<input type="submit" value="Nieuwe Smaak" name="submitType" >
    							</td>
    						</tr>
					</table>
    						<input type="hidden" name="flavorCounter" value="<?php echo count($flavors) ?>">
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