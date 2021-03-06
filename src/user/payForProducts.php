<?php

require_once '../../connection.php';
require_once '../../layout/Layout.php';
require_once 'autoload.php';

session_start();

//jeżeli ktoś wpisze z palca w przeglądarce userPanel.php to jeśli nie jest zalogowany zostanie wyrzucony na stronę głóœną.
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
}
?>
<html>
<?php Layout::showHeadInUser(); ?>
<body>
<div class="container">
    <?php Layout::userTopBar(); ?>
    <hr/>
    <p><a href='userPanel.php'><--Powrót</a></p>
    <?php
    OrderRepository::payForProducts($connection);

    if ($_SERVER['REQUEST_METHOD'] === "GET") {
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $order = OrderRepository::loadOrderById($connection, $id);
            $orderRepository = new OrderRepository();
            $orderRepository->saveToDb($connection, $order);
        }
    }
    ?>
</div>
</body>
</html>