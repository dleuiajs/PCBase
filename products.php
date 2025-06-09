<?php
// load functions
require_once("php/websiteFunctions.php");
use functions\WebsiteFunctions as WebFunc;
// load head
WebFunc::loadPart("head");
?>
<!-- body -->

<body class="main-layout inner_posituong">
   <!-- header -->
   <header>
      <!-- header inner -->
      <?php
      WebFunc::loadPart("header");
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

      <!-- end products -->
      <!--  footer -->
      <?php
      WebFunc::loadPart("footer");
      ?>
      <!-- end footer -->
</body>

</html>