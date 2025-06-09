<?php
// load functions
require_once("php/functions.php");
// load head
loadPart("head");
?>
<!-- body -->

<body class="main-layout">
   <!-- loader  -->
   <!-- <div class="loader_bg">
      <div class="loader"><img src="images/loading.gif" alt="#" /></div>
   </div> -->
   <!-- end loader -->
   <!-- header -->
   <?php
   loadPart("header");
   ?>
   <!-- end header -->
   <!-- banner -->
   <?php
   $data = json_decode(file_get_contents("json/banner.json"), true);
   // load banner
   if (!isset($data['banner']) || empty($data['banner'])) {
      echo '<div class="alert alert-danger" role="alert">Údaje o bannery neboli nájdené alebo sú prázdne.</div>';
   } else {
      echo '<section class="banner_main">
      <div id="banner1" class="carousel slide" data-ride="carousel">
         <ol class="carousel-indicators">';
      for ($i = 0; $i < count($data['banner']); $i++) {
         echo '<li data-target="#banner1" data-slide-to="' . $i . '"' . ($i === 0 ? ' class="active"' : '') . '></li>';
      }
      echo '</ol>
         <div class="carousel-inner">';
      foreach ($data['banner'] as $i => $item) {
         echo '<div class="carousel-item ' . ($i === 0 ? 'active' : '') . '">
               <div class="container">
                  <div class="carousel-caption">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="text-bg">
                              <h1>' . $item['nadpis'] . '</h1>
                              <h2>' . $item['podnadpis'] . '</h2>
                                 <p>' . $item['popis'] . '</p>
                                 <a href="' . $item['kupitOdkaz'] . '">Kúpiť teraz</a> <a href="contact.php">Kontakt</a>
                           </div>
                        </div>
                        <div class="col-md-6 center-vertical">
                           <div class="text_img">
                              <figure><img src="' . $item['img'] . '" alt="#" /></figure>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>';
      }
      echo '</div>
      </div>
   </section>';
   }
   ?>
   <!-- end banner -->
   <!-- three_box -->
   <div class="three_box">
      <div class="container mb-5">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Naše produkty</h2>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-4">
               <div class="box_text">
                  <i><img src="images/category_img_01.png" alt="#" /></i>
                  <h3>Herné počítače</h3>
                  <p>Výkonný herný počítač vytvorený špeciálne na hranie hier s najlepšou grafickou kartou a procesorom.
                     Všetky hry s rezervou 5 rokov bez problémov spustíte.</p>
               </div>
            </div>
            <div class="col-md-4">
               <div class="box_text">
                  <i><img src="images/category_img_02.png" alt="#" /></i>
                  <h3>Pracovné stanice</h3>
                  <p>Pre profesionálov, ktorí potrebujú vysoký výkon na náročné úlohy. Počítač má niekoľko kvalitných
                     grafických kariet a výkonný procesor najmä na náročnú prácu.</p>
               </div>
            </div>
            <div class="col-md-4">
               <div class="box_text">
                  <i><img src="images/category_img_03.png" alt="#" /></i>
                  <h3>Rozpočtové zostavy PC</h3>
                  <p>Cenovo výhodný počítač na každodenné použitie za nízku cenu. Vhodný na nenáročné úlohy, ako je
                     sledovanie videí, surfovanie na internete, ľahká práca atď.</p>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12 text-center mt-4">
               <a class="btn btn-info" style="width:300px; height:50px; line-height:35px;" href="products.php">Zobraziť
                  viac</a>
            </div>
         </div>
      </div>
   </div>
   <!-- three_box -->
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
   <!-- customer -->
   <?php
   require_once("php/productsFunctions.php");
   use products\ProductsFunctions;
   $productsFunctions = new ProductsFunctions();
   $productsFunctions->generateLastReviews();
   ?>
   <!-- end customer -->

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
                        <textarea class="textarea" placeholder="Správa" type="text" , name="sprava" required></textarea>
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
</body>

</html>