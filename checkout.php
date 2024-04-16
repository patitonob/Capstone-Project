<?php
$con = new mysqli("localhost", "id21810557_falconsdb", "Falcons1234.", "id21810557_falconsdb");
if ($con->connect_error) {
    die("Database connection error");
}
session_start();
$user = $_SESSION['user'];
$q1 = $con->query("SELECT * FROM TestOrderDetails tod
 INNER JOIN TestOrders tor ON tod.OrderID=tor.OrderID
 INNER JOIN TestProducts tpr ON tpr.ProductID=tod.ProductID
  WHERE MemberID = $user");
?>
<!DOCTYPE html>
<html>

<head>

    <link rel="stylesheet" type="text/css" href="checkout.css">
    <title> Checkout </title>
</head>
<header>
    <div class="logo">
        <img src="Falcfitlogo.jpg" alt="logo" width="50" height="50">

        <h1>Falcons Fitness</h1>

    </div>
</header>

<main>
    <div class="cart">
        <h2>Your Cart</h2>
        <ul>
            <?php
            $total = 0;
            while ($row = $q1->fetch_assoc()) {
                $product = $row["ProductName"];
                $price = $row["Price"];
                $quantity = $row["Quantity"];
                $total += $row["Subtotal"];
                echo " <li>$product - $$price x $quantity <button class='remove-item'>Remove</button></li>";
            }
            ?>

        </ul>
        <p>Total: <span id="total">$
                <?= $total ?>
            </span></p>
        <a href="/Review_order/review.html"><button id="checkout-btn">Proceed to Checkout</button></a>

    </div>




</html>