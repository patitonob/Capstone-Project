<?php
$con = new mysqli("localhost", "id21810557_falconsdb", "Falcons1234.", "id21810557_falconsdb");
if ($con->connect_error) {
    die("Database connection error");
}
session_start();
$q = $con->query("SELECT * FROM TestProducts;");
$user = $_SESSION['user'];
$q1= $con->query("SELECT COUNT(*) AS products FROM TestOrderDetails tod INNER JOIN TestOrders tor ON tod.OrderID=tor.OrderID WHERE MemberID = $user");
$cont=0;
if ($row= $q1->fetch_assoc()) {
    $cont=$row["products"];
}
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="gym_products.css">
    <title>Products</title>

</head>
<header>
    <div class="logo">
        <img src="Falcfitlogo.jpg" alt="logo">

        <h1>Falcons Fitness</h1>
    </div>
    <nav>
        <ul>
            <li><a href="/Checkout/checkout.php" class="cart-button">Cart <span class="cart-count">  <?= $cont ?></span></a></li>
        </ul>
    </nav>

</header>


<body>
    <h2>Check Our Products</h2>
    <br>
    <h3> Gym Equipment - Supplements</h3>
    <?php
    while ($row = $q->fetch_assoc()) {
        ?>
        <div class="product">
            <img src="<?= $row["Image"] ?>">
            <h4>
                <?= $row["ProductName"] ?>
            </h4>
            <p>$
                <?= $row["Price"] ?>
            </p>
            <form action="process_order.php" method="post">
                <button class="add-to-cart">Add to Cart</button>
                <label for="quantity">Quantity:</label>
                <input type="hidden" name="idproduct" value="<?= $row["ProductID"] ?>">
                <input type="number" id="quantity" name="quantity" min="1" value="1">
            </form>
        </div>
        <?php
    }
    ?>



    <br>
    <div class="icon-cart">
        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="red" viewBox="0 2 18 20">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M6 15a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0h8m-8 0-1-4m9 4a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm-9-4h10l2-7H3m2 7L3 4m0 0-.792-3H1" />
        </svg>
        <span>0</span>
    </div>




</body>

</html>