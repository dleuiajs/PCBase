<header>
    <!-- header inner -->
    <div class="header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col logo_section">
                    <div class="full">
                        <div class="center-desk">
                            <div class="logo">
                                <a href="index.php"><img src="images/logo.png" alt="#" />PCBASE</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- nav bar  -->
                <?php
                require_once("php/websiteFunctions.php");
                use functions\WebsiteFunctions as WebFunc;
                WebFunc::loadPart("navigation");
                ?>
            </div>
        </div>
    </div>
</header>
<!-- end header inner -->