<?php
// load functions
require_once("php/functions.php");
// load head
loadPart("head");
?>
<!-- body -->

<body class="main-layout inner_posituong computer_page">
   <!-- header -->
   <?php
   loadPart("header");
   ?>
   <!-- end header -->
   <!--  pc build -->
   <div class="contact">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Výber komponentov</h2>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-10 offset-md-1">
               <?php
               error_reporting(E_ALL);
               ini_set("display_errors", "On");
               require_once(__ROOT__ . "\php\pcbuildFunctions.php");
               use pcbuild\PcBuildFunctions;
               try {
                  $pcBuild = new PcBuildFunctions();
                  $pcBuild->generateForm();
               } catch (Exception $e) {
                  echo '<h1 class="text-danger">Chyba pri generovaní formulára: ' . $e->getMessage() . '</h1>';
               }
               ?>
            </div>
         </div>
      </div>
   </div>
   <!-- end contact -->
   <!-- laptop  section -->
   <div class="laptop">
      <div class="container">
         <div class="row">
            <div class="col-md-6">
               <div class="titlepage">
                  <p>Každý počítač</p>
                  <h2>Až 40 % zľava!</h2>
                  <a class="read_more" href="products.php">Nakúp teraz</a>
               </div>
            </div>
            <div class="col-md-6">
               <div class="laptop_box">
                  <figure><img src="images/pc.png" alt="#" /></figure>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
   <!-- end laptop  section -->
   <!--  footer -->
   <?php
   loadPart("footer");
   ?>
   <!-- end footer -->
</body>

</html>