<?php
$con = new mysqli("localhost", "id21810557_falconsdb", "Falcons1234.", "id21810557_falconsdb");
if($con->connect_error){
    die("Database connection error");
}
session_start();
if (!empty($_POST["Email"]) && !empty($_POST["password"])){
    $Email = $_POST["Email"];
    $password = $_POST["password"];
    $password = md5($password);
    $q=$con->query("SELECT * FROM MemberTB WHERE Email = '$Email' AND Password = '$password';");
    if ($row=$q->fetch_assoc()) {
        $_SESSION['user']=$row["MemberID"];
        header("location: /main page/main.html");
    }else {
        header("location: /index.html?status=error");

    }
}
$con->close();