<?php

include_once 'connection.php';
require_once 'autoload.php';
require_once '../layout/Layout.php';

session_start();

?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/html">

<?php //metoda wysiwetlająca część Head strony
Layout::showHead();

//sprawdzenie czy użytkownik jest zalogowany
if (!isset($_SESSION['user'])) {
    header("location:index.php");
} else {
    ?>
    <body>
    <div class="container">
        <?php //wywołanie metody pokazującej górny pasek opcji
        Layout::showAllOptionsIndex($connection);
        ?>
        <div id="panel" class="row">
            <div col-md-12 col-sm-12 col-xs-12>
                <h1>ALLEDROGO - niepoważny sklep internetowy</h1>
            </div>
        </div>
        <div class="row mainRow">
            <div class="col-md-2 col-sm-2 col-xs-3 witaj row1">
                <div class="row rowing">
                    <div class="col-md-12 col-sm-12 col-xs-12 rejestracja1 row1 logo">
                        <a href="index.php" class="btn btn-primary btn-block logo">Alledrogo</a>
                    </div>
                    <?php //wywołanie metody, która ma za zadanie wyświetlić wszystkie nazwy grup produktów(lewy side bar)
                    Layout::showGroupName($connection)
                    ?>
                </div>
            </div>
            <div class="col-md-8 tresc col-sm-6 col-xs-6 productInCart" id="mainContent">
                <?php //wywołanie metody, która pokazuje wszystkie przedmioty dodane do koszyka
                Layout::showItem($connection);
                ?>
            </div>
            <div class="col-md-2 col-sm-2 col-xs-3 witaj row1">
                <div class="row rowing">
                    <div class="col-md-12 col-sm-12 col-xs-12 rejestracja1 row1 logo">
                        <div id="line">
                            <a class="btn btn-primary btn-block logo">Bestsellers</a>
                        </div>
                    </div>
                    <div id="productsCarousel" class="carousel slide" data-ride="carousel">
                        <?php //trzy razy wywoływana metoda, której celem jest wylosowanie produktów i wrzucenie ich do karuzeli
                        ?>
                        <div class="carousel-inner">
                            <div class="item active">
                                <?php Layout::getHTML($connection); ?>
                            </div>
                            <div class="item">
                                <?php Layout::getHTML($connection); ?>
                            </div>
                            <div class="item">
                                <?php Layout::getHTML($connection); ?>
                            </div>
                        </div>
                    </div>
                    <div id="productsCarousel" class="carousel slide" data-ride="carousel">
                        <?php //trzy razy wywoływana metoda, której celem jest wylosowanie produktów i wrzucenie ich do karuzeli
                        ?>
                        <div class="carousel-inner">
                            <div class="item active">
                                <?php Layout::getHTML($connection); ?>
                            </div>
                            <div class="item">
                                <?php Layout::getHTML($connection); ?>
                            </div>
                            <div class="item">
                                <?php Layout::getHTML($connection); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row foot">
            <h1>2017 &copy ALLEDROGO</h1>
        </div>
    </div>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.js"></script>
    <script src="../js/style.js"></script>
    </body>
    <?php
}
$connection->close();
?>
</html>