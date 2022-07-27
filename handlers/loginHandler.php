<?php

session_start();

include '../config/database.php';

$emailRegex = "/^[a-zA-Z\d\._]+@[a-zA-Z\d\._]+\.[a-zA-Z\d\.]{2,}+$/";

if (isset($_POST['email']) && isset($_POST['password'])) {

    if (preg_match($emailRegex, $_POST['email'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // fetch from DB
        $sql = "SELECT * FROM users WHERE email='$email'";
        $resultset = mysqli_query($conn, $sql) or die("database error:" . mysqli_error($conn));

        // check if fetched data exists
        if (mysqli_num_rows($resultset)) {
            $row = mysqli_fetch_assoc($resultset);
            $hashedPassword = $row["password"];
            if (password_verify($password, $hashedPassword)) {
                $_SESSION['username'] = $row["username"];
                $data = [
                    "message" => "Login successful",
                    "status" => http_response_code(200)
                ];
            } else {
                $data = [
                    "message" => "E1: Invalid Credentials",
                    // "status" => http_response_code(400)
                    "status" => 400
                ];
            }
        } else {
            $data = [
                "message" => "E2: User not found",
                // "status" => http_response_code(400)
                "status" => 400
            ];
        }
    } else {
        $data = [
            "message" => "E3: Invalid Credentials",
            // "status" => http_response_code(400)
            "status" => 400
        ];
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}
