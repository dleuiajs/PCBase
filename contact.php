<?php
// load functions
require_once("php/functions.php");
// load head
loadPart("head");
?>
<!-- body -->

<body class="main-layout inner_posituong contact_page">
   <!-- header -->
   <?php
   loadPart("header");
   ?>
   <!-- end header -->
   <!--  contact -->
   <div class="contact">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Kontaktujte nás teraz</h2>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-10 offset-md-1">
               <form id="request" class="main_form">
                  <div class="row">
                     <div class="col-md-12 ">
                        <input class="contactus" placeholder="Meno" type="type" name="Name">
                     </div>
                     <div class="col-md-12">
                        <input class="contactus" placeholder="Email" type="type" name="Email">
                     </div>
                     <div class="col-md-12">
                        <input class="contactus" placeholder="Telefónne číslo" type="type" name="Phone Number">
                     </div>
                     <div class="col-md-12">
                        <textarea class="textarea" placeholder="Správa" type="type" Message="Name"></textarea>
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