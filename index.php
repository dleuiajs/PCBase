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
   <section class="banner_main">
      <div id="banner1" class="carousel slide" data-ride="carousel">
         <ol class="carousel-indicators">
            <li data-target="#banner1" data-slide-to="0" class="active"></li>
            <li data-target="#banner1" data-slide-to="1"></li>
            <li data-target="#banner1" data-slide-to="2"></li>
         </ol>
         <div class="carousel-inner">
            <div class="carousel-item active">
               <div class="container">
                  <div class="carousel-caption">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="text-bg">
                              <h1>Herné zostavy – výkon bez kompromisov!</h1>
                              <h2>Maximálny herný zážitok</h3>
                                 <p>
                                    Vyber si herný počítač, ktorý zvládne najnovšie tituly na ultra nastaveniach.
                                    Výkonná grafická karta, rýchly procesor a kvalitné chladenie ti zaručia plynulú hru
                                    bez lagov.
                                    Objav zostavy prispôsobené presne tvojim požiadavkám!
                                 </p>
                                 <a href="#">Kúpiť teraz</a> <a href="contact.html">Kontakt</a>
                           </div>
                        </div>
                        <div class="col-md-6 center-vertical">
                           <div class="text_img">
                              <figure><img src="images/banner_img_01.png" alt="#" /></figure>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="carousel-item">
               <div class="container">
                  <div class="carousel-caption">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="text-bg">
                              <h1>Pracovné stanice – sila pre profesionálov!</h1>
                              <h2>Výkon pre náročné úlohy</h3>
                                 <p>
                                    Renderovanie videí, 3D modelovanie, grafický dizajn – naše pracovné stanice sú
                                    pripravené zvládnuť aj tie
                                    najkomplexnejšie projekty. S rýchlym SSD, vysokou RAM a spoľahlivým procesorom bude
                                    tvoja práca efektívnejšia než kedykoľvek predtým.
                                 </p>
                                 <a href="#">Kúpiť teraz</a> <a href="contact.html">Kontakt</a>
                           </div>
                        </div>
                        <div class="col-md-6 center-vertical">
                           <div class="text_img">
                              <figure><img src="images/banner_img_02.png" alt="#" /></figure>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="carousel-item">
               <div class="container">
                  <div class="carousel-caption">
                     <div class="row">
                        <div class="col-md-6">
                           <div class="text-bg">
                              <h1>Kancelárske a domáce PC – spoľahlivosť každý deň!</h1>
                              <h2>Ideálne riešenie pre prácu a štúdium</h3>
                                 <p>
                                    Hľadáte spoľahlivý počítač na kancelársku prácu, online stretnutia alebo štúdium?
                                    Naše zostavy poskytujú stabilný výkon, nízku spotrebu energie a dlhú životnosť za
                                    zlomok ceny. Pracujte bez obáv s počítačom, ktorý vám umožní pracovať bez toho, aby
                                    vás sklamal.
                                 </p>
                                 <a href="#">Kúpiť teraz</a> <a href="contact.html">Kontakt</a>
                           </div>
                        </div>
                        <div class="col-md-6 center-vertical">
                           <div class="text_img">
                              <figure><img src="images/banner_img_03.png" alt="#" /></figure>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>


         </div>
         <a class="carousel-control-prev" href="#banner1" role="button" data-slide="prev">
            <i class="fa fa-chevron-left" aria-hidden="true"></i>
         </a>
         <a class="carousel-control-next" href="#banner1" role="button" data-slide="next">
            <i class="fa fa-chevron-right" aria-hidden="true"></i>
         </a>
      </div>
   </section>
   <!-- end banner -->
   <!-- three_box -->
   <div class="three_box">
      <div class="container">
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
      </div>
   </div>
   <!-- three_box -->
   <!-- products -->
   <div class="products">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Naše produkty</h2>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div class="our_products">
                  <div class="row">
                     <div class="col-md-4 margin_bottom1">
                        <div class="product_box">
                           <figure><img src="images/product3.png" alt="#" /></figure>
                           <h3>Počítač</h3>
                        </div>
                     </div>
                     <div class="col-md-4 margin_bottom1">
                        <div class="product_box">
                           <figure><img src="images/product1.png" alt="#" /></figure>
                           <h3>Klávesnica</h3>
                        </div>
                     </div>
                     <div class="col-md-4 margin_bottom1">
                        <div class="product_box">
                           <figure><img src="images/product2.png" alt="#" /></figure>
                           <h3>Myš</h3>
                        </div>
                     </div>
                     <div class="col-md-4 margin_bottom1">
                        <div class="product_box">
                           <figure><img src="images/product4.png" alt="#" /></figure>
                           <h3>Reproduktory</h3>
                        </div>
                     </div>
                     <div class="col-md-4 margin_bottom1">
                        <div class="product_box">
                           <figure><img src="images/product5.png" alt="#" /></figure>
                           <h3>Internet</h3>
                        </div>
                     </div>
                     <div class="col-md-4 margin_bottom1">
                        <div class="product_box">
                           <figure><img src="images/product6.png" alt="#" /></figure>
                           <h3>Pevný disk</h3>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="product_box">
                           <figure><img src="images/product7.png" alt="#" /></figure>
                           <h3>Rams</h3>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="product_box">
                           <figure><img src="images/product8.png" alt="#" /></figure>
                           <h3>Batéria</h3>
                        </div>
                     </div>
                     <div class="col-md-4">
                        <div class="product_box">
                           <figure><img src="images/product9.png" alt="#" /></figure>
                           <h3>Optická mechanika</h3>
                        </div>
                     </div>
                     <div class="col-md-12">
                        <a class="read_more" href="products.php">Zobraziť viac</a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- end products -->
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
   <div class="customer">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <div class="titlepage">
                  <h2>Recenzia zákazníka</h2>
               </div>
            </div>
         </div>
         <div class="row">
            <div class="col-md-12">
               <div id="myCarousel" class="carousel slide customer_Carousel " data-ride="carousel">
                  <ol class="carousel-indicators">
                     <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                     <li data-target="#myCarousel" data-slide-to="1"></li>
                     <li data-target="#myCarousel" data-slide-to="2"></li>
                  </ol>
                  <div class="carousel-inner">
                     <div class="carousel-item active">
                        <div class="container">
                           <div class="carousel-caption ">
                              <div class="row">
                                 <div class="col-md-9 offset-md-3">
                                    <div class="test_box">
                                       <i><img src="images/cos.png" alt="#" /></i>
                                       <h4>Peter Novák</h4>
                                       <p>Som veľmi spokojný s nákupom! Počítač mi zostavili rýchlo a efektívne. Pracuje
                                          bez problémov a je perfektný na hranie hier aj na prácu s grafikou. Služby sú
                                          na vysokej úrovni, každému odporúčam tento obchod!</p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="carousel-item">
                        <div class="container">
                           <div class="carousel-caption">
                              <div class="row">
                                 <div class="col-md-9 offset-md-3">
                                    <div class="test_box">
                                       <i><img src="images/cos.png" alt="#" /></i>
                                       <h4>Ján Horváth</h4>
                                       <p>Hľadal som ideálny herný počítač a našiel som ho tu! Počítač je neuveriteľne
                                          rýchly, bez akýchkoľvek lagov, a grafika je úžasná. Zostava bola prispôsobená
                                          presne mojim potrebám a požiadavkám. Dostal som perfektný produkt a som
                                          maximálne spokojný so službami!</p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="carousel-item">
                        <div class="container">
                           <div class="carousel-caption">
                              <div class="row">
                                 <div class="col-md-9 offset-md-3">
                                    <div class="test_box">
                                       <i><img src="images/cos.png" alt="#" /></i>
                                       <h4>Katarína Pálová</h4>
                                       <p>Nákup bol veľmi jednoduchý a rýchly. S pomocou predajcu som si vybrala správnu
                                          konfiguráciu podľa toho, na čo budem počítač používať. Počítač je stabilný a
                                          má výborný výkon. K tomu ešte skvelý zákaznícky servis, ktorý odpovedal na
                                          všetky moje otázky.</p>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                     <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                     <span class="sr-only">Predchádzajúci</span>
                  </a>
                  <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                     <span class="carousel-control-next-icon" aria-hidden="true"></span>
                     <span class="sr-only">Ďalší</span>
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
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