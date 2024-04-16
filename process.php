<?php
$con = new mysqli("localhost", "id21810557_falconsdb", "Falcons1234.", "id21810557_falconsdb");
if($con->connect_error){
    die("Database connection error");
}

if (!empty($_POST["exercise"]) && !empty($_POST["duration"]) && !empty($_POST["calories"])) {
    $exercise = $_POST["exercise"];
    $duration = $_POST["duration"];
    $calories = $_POST["calories"];
    $q=$con->query("INSERT INTO WorkoutLog VALUES ('$exercise', $duration, $calories);");
    if ($q===TRUE) {
        header("location: /index.html?status=success");
    }else {
        header("location: /index.html?status=error");

    }
}
$con->close();