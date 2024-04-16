<?php
$con = new mysqli("localhost", "id21810557_falconsdb", "Falcons1234.", "id21810557_falconsdb");
if($con->connect_error){
    die("Database connection error");
}
session_start();
if (!empty($_POST["username"]) && !empty($_POST["email"]) && !empty($_POST["password"])) {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];
    if ($password != $confirm_password) {
        header("location: C_account.html?status=password");
    }
    $password = md5($password);
    $id = randomID();
    $sql = "INSERT INTO MemberTB (MemberID, Username, Email, Password";
    $values = "VALUES ($id, '$username','$email','$password'";
    if (!empty($_POST['first_name'])){
        $sql .= ',FirstName';
        $firstname = $_POST['first_name'];
        $values .= ",'$firstname'";
    }
    if (!empty($_POST['last_name'])){
        $sql .= ',LastName';
        $lastname = $_POST['last_name'];
        $values .= ",'$lastname'";
    }
    if (!empty($_POST['dob'])){
        $sql .= ',DOB';
        $dob = $_POST['dob'];
        $values .= ",'$dob'";
    }
    $sql.=") $values)";
    $q=$con->query($sql);
    if ($q===TRUE) {
        $_SESSION['user']=$id;
        header("location: /main page/main.html");
    }else {
        header("location: C_account.html?status=error");

    }
}
$con->close();


function randomID () {
    global $con;
    $result = $con->query("SELECT MemberID FROM MemberTB");
    $ids=[];
    while ($row = $result->fetch_assoc()) {
        $ids[]=$row["MemberID"];
    }
    while (true){
        $num = rand(1,99999);
        if (!in_array($num, $ids)) {
            return $num;
        }

    }
}