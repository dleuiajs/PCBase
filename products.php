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
     
                        
                        <?php
                        // nahravanie tovarov
                        require_once("php/productsFunctions.php");
                        use products\ProductsFunctions;
                        $productsFunctions = new ProductsFunctions();
                        $productsFunctions->generateProductsList();
                        ?>
                        <!-- <div class="col-md-3">
                           <a href="product.php?id=1">
                              <div class="product_box">
                                 <figure><img src="images/category_img_01.png" alt="#" /></figure>
                                 <p class="name">Výkonný počítač na hranie hier</p>
                                 <p class="availability in-stock">Na sklade</p>
                                 <p class="price">1 499</p>
                              </div>
                           </a>
                        </div> -->

                        <!-- <div class="col-md-3">
                           <a href="product.php?id=2">
                              <div class="product_box">
                                 <figure><img src="images/category_img_02.png" alt="#" /></figure>
                                 <p class="name">Veľmi výkonný počítač na náročnú prácu</p>
                                 <p class="availability in-stock">Na sklade</p>
                                 <p class="price">2 199</p>
                              </div>
                           </a>
                        </div>

                        <div class="col-md-3">
                           <a href="product.php?id=3">
                              <div class="product_box">
                                 <figure><img src="images/banner_img_02.png" alt="#" /></figure>
                                 <p class="name">Počítač na prácu s 3D grafikou</p>
                                 <p class="availability in-stock">Na sklade</p>
                                 <p class="price">1 699</p>
                              </div>
                           </a>
                        </div>

                        <div class="col-md-3">
                           <a href="product.php?id=4">
                              <div class="product_box">
                                 <figure><img src="images/category_img_03.png" alt="#" /></figure>
                                 <p class="name">Rozpočtový herný počítač na hranie na minimálnych nastaveniach</p>
                                 <p class="availability out-of-stock">Vypredané</p>
                                 <p class="price">349</p>
                              </div>
                           </a>
                        </div>

                        <div class="col-md-3">
                           <a href="product.php?id=5">
                              <div class="product_box">
                                 <figure><img src="images/banner_img_03.png" alt="#" /></figure>
                                 <p class="name">Lacný počítač na jednoduché účely</p>
                                 <p class="availability in-stock">Na sklade</p>
                                 <p class="price">289</p>
                              </div>
                           </a>
                        </div> -->
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