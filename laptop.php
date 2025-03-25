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
   <!-- laptop1 -->
   <div class="laptop1">
      <div class="container">
         <div class="row">
            <div class="col-md-7">
               <div class="laptop1_img">
                  <figure><img src="images/leptop.jpg" alt="#" /></figure>
               </div>
            </div>
            <div class="col-md-5">
               <div class="titlepage">
                  <h2>laptop</h2>
                  <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut
                     labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo
                     dolores et ea rebum.</p>
                  <a class="read_more" href="#">Read More</a>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end laptop1 -->
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