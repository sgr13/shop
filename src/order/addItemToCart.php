<?php

require_once '../../connection.php';
require_once '../../config.php';
require_once '../../layout/Layout.php';
require_once 'autoload.php';

session_start();

if (!isset($_SESSION['user'])) {
    header('Location: web/index.php');
}
?>
<html>
<?php Layout::showHeadInMain(); ?>
<body>
<div class="container">
    <div class="wrapper">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === "GET") {
            if (isset($_GET['name']) && isset($_GET['path'])) {
                $name = $_GET['name'];
                $path = $_GET['path'];
                $item = ItemRepository::loadItemByName($connection, $name);
                $id = $item->getId();
                $availability = $item->getAvailability();
                $result = SqlQueries::getCartItemId($connection);
                foreach ($result as $value) {
                    $tab[] = $value['item_id'];
                }
                if (in_array($id, $tab)) {
                    header('Location: ../../web/koszyk.php');
                } else {
                    if ($availability <= 0) {
                        echo "Brak produktu. Prosze spróbować później.<br>";
                        echo "<a style='margin-left: 130px' href='web/product.php?id=" . $id . "'><button>OK</button></a>";
                    } else {
                        $price = $item->getPrice();
                        $userName = $_SESSION['user'];
                        $user = UserRepository::loadUserByName($connection, $userName);
                        $userId = $user->getId();
                        $sql = "INSERT INTO cart(path, user_id, item_id) VALUES('$path', '$userId', '$id' )";
                        $result = $connection->query($sql);
                        if (!$result) {
                            die ("Błąd zapisu do bazy danych - Cart" . $connection->connect_errno);
                        }
                        header("Location: ../../web/koszyk.php");
                    }
                }
            }
        }
        ?>
    </div>
</div>
</body>
</html>