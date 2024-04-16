<?php
$con = new mysqli("localhost", "id21810557_falconsdb", "Falcons1234.", "id21810557_falconsdb");
if ($con->connect_error) {
    die("Database connection error");
}
session_start();

if (!empty($_POST["idproduct"]) && !empty($_POST["quantity"])) {
    $quantity = $_POST["quantity"];
    $id = $_POST["idproduct"];
    $user = $_SESSION['user'];
    $con->query("INSERT INTO TestOrders (MemberID,OrderDate) VALUES ($user,now())");
    $ido = $con->insert_id;
    $result = $con->query("SELECT * FROM TestProducts WHERE ProductID=$id");
    $price = 0;
    if ($row = $result->fetch_assoc()) {
        $price = $row["Price"] * $quantity;
    }
    $con->query("INSERT INTO TestOrderDetails (OrderID,ProductID,Quantity,Subtotal) VALUES ($ido,$id,$quantity,$price);");
    header("location: gym_products.php");
    //falta insertar los detalles y relacionar el producto
}

