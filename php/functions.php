<?php
function loadPart(string $name)
{
    $path = "parts/" . $name . ".php";
    if (!require_once($path)) {
        echo "Chyba: Nepodarilo sa načítať" . $name . ".php";
    }
}
function neuvedeneIfNull($value)
{
    return !empty($value) ? $value : 'Neuvedené';
}

function optionSelect($variable, $value)
{
    return $variable == $value ? 'selected' : '';
}

function showErrorPage($error)
{
    loadPart("head");
    echo '
    <body class="main-layout inner_posituong">
        <header>';
    loadPart("header");
    echo ' </header>';
    echo '<div class="container text-center">
            <h1 class="mt-5">Chyba</h1>
            <p class="lead">' . $error . '</p>
          </div>';
    loadPart("footer");

    echo '<script src="js/jquery.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.0.0.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>';
}

?>