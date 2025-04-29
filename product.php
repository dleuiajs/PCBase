<?php
// load functions
require_once("php/functions.php");
// load head
loadPart("head");
?>
<!-- body -->

<body class="main-layout inner_posituong">
   <!-- header -->
   <header>
      <!-- header inner -->
      <?php
      loadPart("header");
      ?>
      <!-- end header -->
      <!-- products -->
      <div class="products">
         <div class="container">
            <div class="row">
               <div class="col-md-12">
                  <div class="titlepage">
                     <h2>Tovary</h2>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col-md-12">
                  <div class="our_products">
                     <div class="row ">
                        <div class="col-md-12 margin_bottom1">
                           <form id="request" class="">
                              <div class="row justify-content-between">
                                 <div class="col-md-6 ">
                                    <label for="search">Zadajte názov</label><br>
                                    <input class="search" type="text" name="search" placeholder="Zadajte názov">
                                 </div>
                                 <div class="col-md-6 ">
                                    <label for="sort">Zoradiť podľa:</label><br>
                                    <select id="sort" name="sort" onchange="this.form.submit()">
                                       <option value="default">Predvolené zoradenie</option>
                                       <option value="price-asc">Cena: od najnižšej</option>
                                       <option value="price-desc">Cena: od najvyššej</option>
                                       <option value="popularity">Podľa obľúbenosti</option>
                                       <option value="newest">Najnovšie</option>
                                    </select>
                                 </div>
                              </div>
                           </form>
                        </div>
                        <div class="col-md-3">
                           <div class="product_box">
                              <figure><img src="images/category_img_01.png" alt="#" /></figure>
                              <p class="name">Výkonný počítač na hranie hier</p>
                              <p class="availability in-stock">Na sklade</p>
                              <p class="price">1 499</p>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="product_box">
                              <figure><img src="images/category_img_02.png" alt="#" /></figure>
                              <p class="name">Veľmi výkonný počítač na náročnú prácu</p>
                              <p class="availability in-stock">Na sklade</p>
                              <p class="price">2 199</p>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="product_box">
                              <figure><img src="images/banner_img_02.png" alt="#" /></figure>
                              <p class="name">Počítač na prácu s 3D grafikou</p>
                              <p class="availability in-stock">Na sklade</p>
                              <p class="price">1 699</p>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="product_box">
                              <figure><img src="images/category_img_03.png" alt="#" /></figure>
                              <p class="name">Rozpočtový herný počítač na hranie na minimálnych nastaveniach</p>
                              <p class="availability out-of-stock">Vypredané </p>
                              <p class="price">349</p>
                           </div>
                        </div>
                        <div class="col-md-3">
                           <div class="product_box">
                              <figure><img src="images/banner_img_03.png" alt="#" /></figure>
                              <p class="name">Lacný počítač na jednoduché účely</p>
                              <p class="availability in-stock">Na sklade</p>
                              <p class="price">289</p>
                           </div>
                        </div>
                        <!-- <div class="col-md-12">
                           <a class="read_more" href="#">See More</a>
                        </div> -->
                        <!-- <div class="col-md-12">
                           <div class="pagination">
                              <a href="#">&laquo;</a>
                              <a href="#" class="active">1</a>
                              <a href="#">2</a>
                              <a href="#">3</a>
                              <a href="#">&raquo;</a>
                           </div> -->

                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- end products -->
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