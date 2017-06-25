<?php

require_once 'connection.php';
require_once 'autoload.php';
require_once 'layout/Layout.php';

session_start();

//jeżeli ktoś wpisze z palca w przeglądarce userPanel.php to jeśli nie jest zalogowany zostanie wyrzucony na stronę głóœną.
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}
?>
<html>
<?php Layout::showHeadInMain(); ?>
<body>
<div class="container">
    <?php Layout::UserTopBar(); ?>
    <hr/>
    <p><a href='userPanel.php'><--Powrót</a></p>
    <?php
    Order::payForProducts($connection);

    if ($_SERVER['REQUEST_METHOD'] === "GET") {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $order = Order::loadOrderById($connection, $id);
            $order->updateStatus($connection);
        }
    }
    ?>
</div>
</body>
</html>