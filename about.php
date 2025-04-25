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
   <!-- about section -->
   <div class="about">
      <div class="container">
         <div class="row d_flex">
            <div class="col-md-5">
               <div class="titlepage">
                  <h2>O nás</h2>
                  <p>Venujeme sa profesionálnej stavbe počítačov na zákazku – od spoľahlivých kancelárskych riešení až
                     po výkonné herné zostavy. Každý počítač navrhujeme individuálne podľa potrieb zákazníka a jeho
                     rozpočtu, s dôrazom na kvalitu, stabilitu a čistú kabeláž.
                     <br><br>
                     Okrem služieb v oblasti stavby PC ponúkame aj predaj rôznych zariadení – tablety, počítačové
                     príslušenstvo, periférie a iné elektronické komponenty. Všetky produkty sú overené a ponúkané za
                     konkurencieschopné ceny.
                     <br><br>
                     Naším cieľom je poskytovať spoľahlivé riešenia a odborný prístup pri každom projekte.
                     <br><br>
                     Neváhajte nás kontaktovať – radi vám pomôžeme nájsť ideálne technologické riešenie.
                  </p>
                  <!-- <a class="read_more" href="#">Read More</a> -->
               </div>
            </div>
            <div class="col-md-7">
               <div class="about_img">
                  <figure><img src="images/about.jpg" alt="#" /></figure>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div>
   <!-- end about section -->
   <!--  footer -->
   <?php
   loadPart("footer");
   ?>
   <!-- end footer -->
   <!-- Javascript files-->
   <script src="js/jquery.min.js"></script>
   <script src="js/popper.min.js"></script>
   <script src="js/bootstrap.bundle.min.js"></script>
   <script src="js/jquery-3.0.0.min.js"></script>
   <!-- sidebar -->
   <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
   <script src="js/custom.js"></script>
</body>

</html>