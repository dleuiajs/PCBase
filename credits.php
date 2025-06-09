<?php
require_once("php/websiteFunctions.php");
use functions\WebsiteFunctions as WebFunc;
WebFunc::loadPart("head");
?>

<body class="main-layout inner_posituong">
    <header>
        <?php
        WebFunc::loadPart("header");
        ?>
    </header>
    <main class="credits-section py-5 bg-light">
        <div class="container" style="max-width: 900px;">
            <h2 class="text-center mb-4">Autori obrázkov</h2>
            <div class="row justify-content-center g-4">
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm text-center">
                        <img src="https://storage.needpix.com/rsynced_images/motherboard-4094458_1280.png"
                            class="card-img-top rounded-top p-4" style="" alt="Logo">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Logo</h5>
                            <p class="card-text text-muted mb-0"><a
                                    href="https://www.needpix.com/photo/1828206/motherboard-board-computer-computer-motherboard-icon-free-vector-graphics">Autor:
                                    IO-Images</a></p>
                            <p class="card-text text-muted mb-0"><a
                                    href="https://creativecommons.org/public-domain/cc0/">Licencia: CC0</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm text-center">
                        <img src="images/category_img_03.png" class="card-img-top rounded-top" alt="Počítač 1">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Avant-Tower-Gaming-PC</h5>
                            <p class="card-text text-muted mb-0"><a
                                    href="https://commons.wikimedia.org/wiki/File:Avant-Tower-Gaming-PC.png">Autor:
                                    Nikitarama</a></p>
                            <p class="card-text text-muted mb-0"><a
                                    href="https://creativecommons.org/licenses/by-sa/4.0/deed.en">Licencia: CC BY-SA
                                    4.0</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm text-center">
                        <img src="images/banner_img_01.png" class="card-img-top rounded-top p-4" alt="Počítač 2">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Avalanche Hardline Liquid Cooled Gaming PC</h5>
                            <p class="card-text text-muted mb-0"><a
                                    href="https://commons.wikimedia.org/wiki/File:Avalanche_Hardline_Liquid_Cooled_Gaming_PC.png">Autor:
                                    Nikitarama</a></p>
                            <p class="card-text text-muted mb-0"><a
                                    href="https://creativecommons.org/licenses/by-sa/4.0/deed.en">Licencia: CC BY-SA
                                    4.0</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm text-center">
                        <img src="images/banner_img_02.png" class="card-img-top rounded-top p-4" alt="Počítač 2">
                        <div class="card-body">
                            <h5 class="card-title mb-1">AVADirect-Custom-X99-Intel-Core-i7-gaming-cpu</h5>
                            <p class="card-text text-muted mb-0"><a
                                    href="https://commons.wikimedia.org/wiki/File:AVADirect-Custom-X99-Intel-Core-i7-gaming-cpu.png">Autor:
                                    Cmccarthy8</a></p>
                            <p class="card-text text-muted mb-0"><a
                                    href="https://creativecommons.org/licenses/by-sa/4.0/deed.en">Licencia: CC BY-SA
                                    4.0</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm text-center">
                        <img src="images/category_img_02.png" class="card-img-top rounded-top" alt="Počítač 2">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Quad-GeForce-GTX-Titan-Black-Ultimate-GPU-Gaming-Computer</h5>
                            <p class="card-text text-muted mb-0"><a
                                    href="https://commons.wikimedia.org/wiki/File:Quad-GeForce-GTX-Titan-Black-Ultimate-GPU-Gaming-Computer.png">Autor:
                                    Cmccarthy8</a></p>
                            <p class="card-text text-muted mb-0"><a
                                    href="https://creativecommons.org/licenses/by-sa/4.0/deed.en">Licencia: CC BY-SA
                                    4.0</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm text-center">
                        <img src="images/banner_img_03.png" class="card-img-top rounded-top p-4" alt="Počítač 2">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Falcon Northwest Mach V full tower desktop PC</h5>
                            <p class="card-text text-muted mb-0"><a
                                    href="https://commons.wikimedia.org/wiki/File:Falcon_Northwest_Mach_V_full_tower_desktop_PC.png">Autor:
                                    Falcon Northwest</a></p>
                            <p class="card-text text-muted mb-0"><a
                                    href="https://creativecommons.org/licenses/by-sa/4.0/deed.en">Licencia: CC BY-SA
                                    4.0</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <p class="text-center mt-4 text-secondary">
                Ďakujeme všetkým autorom za ich úžasné obrázky použité na tejto stránke.
            </p>
        </div>
    </main>
    <?php WebFunc::loadPart("footer"); ?>
</body>

</html>