<?php
require_once("php/functions.php");
loadPart("head");
?>

<body class="main-layout inner_posituong">
    <header>
        <?php loadPart("header"); ?>
    </header>

    <div class="tovar">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="product-image">
                        <img src="images/category_img_01.png" alt="Výkonný počítač na hranie hier" class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-info">
                        <p class="name">Výkonný počítač na hranie hier</p>
                        <p class="description">Výkonný herný počítač vytvorený špeciálne na hranie hier s najlepšou
                            grafickou kartou a procesorom. Všetky hry s rezervou 5 rokov bez problémov spustíte.</p>
                        <p class="availability in-stock">Na sklade</p>
                        <p class="price">1 499</p>
                        <form method="post" action="thxyou.php">
                            <input type="hidden" name="product_id" value="1">
                            <button type="submit" class="btn btn-primary" style="width:160px;">Kúpiť</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Detailed Description Section -->
            <div class="row mt-5">
                <div class="col-md-12">
                    <div class="product-details">
                        <h3 class="text-center mb-4">Podrobnosti o produkte</h3>
                        <div class="product-specs">
                            <div class="spec-item">
                                <span class="spec-label">Typ procesora:</span>
                                <span class="spec-value">Intel Core i9-14900K</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">Grafická karta:</span>
                                <span class="spec-value"> ASUS TUF GeForce RTX 3080 GAMING V2 O10G</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">RAM:</span>
                                <span class="spec-value">Kingston FURY 32 GB KIT DDR4 3200 MHz CL16 Beast Black
                                    1Gx8</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">Úložisko:</span>
                                <span class="spec-value">Samsung 990 PRO SSD M.2</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">Operačný systém:</span>
                                <span class="spec-value">Windows 11 Pro</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">Chladenie:</span>
                                <span class="spec-value">Pokročilý systém vodného chladenia</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">Rozmery:</span>
                                <span class="spec-value">450mm x 210mm x 450mm</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">Hmotnosť:</span>
                                <span class="spec-value">15 kg</span>
                            </div>
                            <div class="spec-item">
                                <span class="spec-label">Záruka:</span>
                                <span class="spec-value">2 roky</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Customer Reviews Section -->
            <div class="row mt-5 mb-5">
                <div class="col-md-12">
                    <div class="reviews-section">
                        <h3 class="text-center mb-4">Recenzie zákazníkov</h3>
                        <div class="review-card">
                            <div class="review-avatar">
                                <img src="images/avatars/avatar1.jpg" alt="avatar">
                            </div>
                            <div class="review-content">
                                <h5>Peter Novák</h5>
                                <div class="stars">★★★★★</div>
                                <p>Tento počítač je doslova raketa. Všetko ide rýchlo, aj tie najnovšie hry na ultra
                                    detailoch!</p>
                            </div>
                        </div>

                        <div class="review-card">
                            <div class="review-avatar">
                                <img src="images/avatars/avatar2.jpg" alt="avatar">
                            </div>
                            <div class="review-content">
                                <h5>Jana Kováčová</h5>
                                <div class="stars">★★★★☆</div>
                                <p>Veľmi spokojná! Doručenie bolo rýchle a kvalita zodpovedá cene. Jedna hviezdička dole
                                    za hlučný ventilátor.</p>
                            </div>
                        </div>

                        <div class="review-card">
                            <div class="review-avatar">
                                <img src="images/avatars/avatar3.jpg" alt="avatar">
                            </div>
                            <div class="review-content">
                                <h5>Marek Bielik</h5>
                                <div class="stars">★★★★★</div>
                                <p>Najlepší nákup tohto roka. PC beží stabilne aj pri renderovaní videí a hraní VR hier.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <?php loadPart("footer"); ?>

    <!-- Javascript files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>