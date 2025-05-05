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
               <form id="request" class="main_form">
                  <div class="row">
                     <div class="col-md-12 ">
                        <label for="gpu">Vyberte grafickú kartu:</label><br>
                        <select id="gpu" name="gpu">
                           <option value="rx550">Radeon RX 550</option>
                           <option value="gt1030">GeForce GT 1030</option>
                           <option value="rx6650xt">Radeon RX 6650 XT</option>
                           <option value="gtx1080ti">GeForce GTX 1080 Ti</option>
                           <option value="rtx3060">GeForce RTX 3060</option>
                           <option value="rtx3090">GeForce RTX 3090</option>
                           <option value="rx6900xt">Radeon RX 6900 XT</option>
                           <option value="rx7900xt">Radeon RX 7900 XT</option>
                           <option value="rtx4060">GeForce RTX 4060</option>
                           <option value="rtx4090">GeForce RTX 4090</option>
                           <option value="rtx5090">GeForce RTX 5090</option>
                        </select>
                     </div>
                     <div class="col-md-12">
                        <label for="motherboard">Vyberte základnú dosku:</label><br>
                        <select id="motherboard" name="motherboard">
                           <option value="msi-h310m">MSI H310M</option>
                           <option value="gigabyte-b365m">Gigabyte B365M</option>
                           <option value="asrock-h410m">ASRock H410M</option>
                           <option value="asrock-b460m">ASRock B460M</option>
                           <option value="msi-b450m">MSI B450M</option>
                           <option value="asus-x570">ASUS X570</option>
                           <option value="gigabyte-b550">Gigabyte B550</option>
                           <option value="asus-z690">ASUS Z690</option>
                           <option value="msi-z790">MSI Z790</option>
                        </select>
                     </div>
                     <div class="col-md-12 ">
                        <label for="cpu">Vyberte procesor:</label><br>
                        <select id="cpu" name="cpu">
                           <option value="pentium-g6400">Intel Pentium Gold G6400</option>
                           <option value="celeron-g5900">Intel Celeron G5900</option>
                           <option value="i3-10100F">Intel Core i3-10100F</option>
                           <option value="i3-12100">Intel Core i3-12100</option>
                           <option value="i5-12600K">Intel Core i5-12600K</option>
                           <option value="i7-13700K">Intel Core i7-13700K</option>
                           <option value="i9-13900K">Intel Core i9-13900K</option>
                           <option value="ryzen3-3200G">AMD Ryzen 3 3200G</option>
                           <option value="athlon-3000G">AMD Athlon 3000G</option>
                           <option value="ryzen3-3200G">AMD Ryzen 3 3200G</option>
                           <option value="ryzen3-4100">AMD Ryzen 3 4100</option>
                           <option value="ryzen5-5600X">AMD Ryzen 5 5600X</option>
                           <option value="ryzen7-5800X">AMD Ryzen 7 5800X</option>
                           <option value="ryzen9-7900X">AMD Ryzen 9 7900X</option>
                        </select>
                     </div>
                     <div class="col-md-12">
                        <label for="ram">Vyberte operačnú pamäť:</label><br>
                        <select id="ram" name="ram">
                           <option value="8gb-ddr3">4GB DDR3</option>
                           <option value="8gb-ddr3">8GB DDR3</option>
                           <option value="4gb-ddr4">4GB DDR4</option>
                           <option value="8gb-ddr4">8GB DDR4</option>
                           <option value="16gb-ddr4">16GB DDR4</option>
                           <option value="32gb-ddr4">32GB DDR4</option>
                           <option value="16gb-ddr5">16GB DDR5</option>
                           <option value="32gb-ddr5">32GB DDR5</option>
                        </select>
                     </div>
                     <div class="col-md-12">
                        <label for="psu">Vyberte napájací zdroj:</label><br>
                        <select id="psu" name="psu">
                           <option value="fsp-350w">FSP 350W</option>
                           <option value="chieftec-450w">Chieftec 450W</option>
                           <option value="antec-500w">Antec 500W</option>
                           <option value="coolermaster-400w">Cooler Master 400W</option>
                           <option value="corsair-450w">Corsair 450W</option>
                           <option value="bequiet-500w">Be Quiet! 500W</option>
                           <option value="evga-600w">EVGA 600W</option>
                           <option value="seasonic-750w">Seasonic 750W</option>
                           <option value="coolermaster-850w">Cooler Master 850W</option>
                           <option value="corsair-1000w">Corsair 1000W</option>
                        </select>
                     </div>
                     <div class="col-md-12">
                        <label for="cooling">Vyberte chladenie:</label><br>
                        <select id="cooling" name="cooling">
                           <option value="coolermaster-elite">Cooler Master Elite</option>
                           <option value="deepcool-gamerstorm">Deepcool GamerStorm</option>
                           <option value="coolermaster-hyper212">Cooler Master Hyper 212</option>
                           <option value="bequiet-darkrock4">Be Quiet! Dark Rock 4</option>
                           <option value="nzxt-kraken-x63">NZXT Kraken X63</option>
                           <option value="corsair-h100i">Corsair H100i</option>
                           <option value="arctic-freezer-34">Arctic Freezer 34</option>
                        </select>
                     </div>
                     <div class="col-md-12">
                        <label for="budget">Zadajte rozpočet:</label><br>
                        <input type="number" id="budget" name="budget" placeholder="Zadajte rozpočet" min="0"
                           step="1"><br>
                     </div>
                     <div class="col-md-12">
                        <label for="email">Zadajte e‑mail:</label><br>
                        <input type="email" id="email" name="email" placeholder="Zadajte e‑mail">
                     </div>
                     <div class="col-md-12">
                        <button class="send_btn">Odoslať</button>
                     </div>
                  </div>
               </form>
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