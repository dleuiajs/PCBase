<?php
// load functions
require_once("php/functions.php");
// load head
loadPart("head");
?>
<!-- body -->

<body class="main-layout inner_posituong">
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
               <form id="request" class="main_form" action="thxyou_contact.php" method="post">
                  <div class="row">
                     <div class="col-md-12 ">
                        <input class="contactus" placeholder="Meno" type="text" name="meno" required>
                     </div>
                     <div class="col-md-12">
                        <input class="contactus" placeholder="Email" type="email" name="email" required>
                     </div>
                     <div class="col-md-12">
                        <input class="contactus" placeholder="Telefónne číslo" type="tel" name="tel_cislo">
                     </div>
                     <div class="col-md-12">
                        <textarea class="textarea" placeholder="Správa" type="text", name="sprava" required></textarea>
                     </div>
                     <div class="col-md-12">
                        <button class="send_btn" type="submit">Odoslať</button>
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