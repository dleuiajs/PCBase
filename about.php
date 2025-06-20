<?php
// load functions
require_once("php/websiteFunctions.php");
use functions\WebsiteFunctions as WebFunc;
// load head
WebFunc::loadPart("head");
?>
<!-- body -->

<body class="main-layout inner_posituong computer_page">
   <!-- header -->
   <?php
   WebFunc::loadPart("header");
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
   WebFunc::loadPart("footer");
   ?>
   <!-- end footer -->
</body>

</html>