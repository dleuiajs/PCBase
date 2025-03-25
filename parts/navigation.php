<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">
    <nav class="navigation navbar navbar-expand-md navbar-dark ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExample04"
            aria-controls="navbarsExample04" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExample04">
            <ul class="navbar-nav mr-auto">
                <?php
                // načítanie údajov zo súboru json
                $links = json_decode(file_get_contents("json/navLinks.json"), true);
                // pre každý odkaz
                foreach ($links as $href => $title) {
                    echo "<li class=\"nav-item ";
                    // ak sa kľúč zhoduje s názvom stránky
                    if (basename($_SERVER['REQUEST_URI']) == $href)
                        // pridame triedu aktív
                        echo "active";
                    echo "\">
                    <a class=\"nav-link\" href=\"" . $href . "\">" . $title . "</a>
                    </li>";
                }
                ?>
            </ul>
        </div>
    </nav>
</div>