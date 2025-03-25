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
   <!-- laptop  section -->
   <div class="laptop">
      <div class="container">
         <div class="row">
            <div class="col-md-6">
               <div class="titlepage">
                  <p>Every Computer and laptop</p>
                  <h2>Up to 40% off !</h2>
                  <a class="read_more" href="#">Shop Now</a>
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