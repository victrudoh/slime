<?php

session_start();

include '../config/database.php';

$username = $email = $password = $confirmPassword = $phone = '';
$usernameErr = $emailErr = $passwordErr = $confirmPasswordErr = $phoneErr = '';


$emailRegex = "/^[a-zA-Z\d\._]+@[a-zA-Z\d\._]+\.[a-zA-Z\d\.]{2,}+$/";
$passwordRegex = "/^[a-zA-Z\d\w.]{6,}$/";
$phoneRegex = "/^[0][\d]{10,}$/";

if (isset($_POST["username"])) {

    // validate username
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // validate email
    if (preg_match($emailRegex, $_POST['email'])) {
        $select = mysqli_query($conn, "SELECT * FROM users WHERE email = '" . $_POST['email'] . "'");
        if (mysqli_num_rows($select)) {
            $data = [
                "message" => "This email is taken",
                "status" => 400
            ];
        } else {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // validate password
            if (preg_match($passwordRegex, $_POST['password'])) {
                $pass1 = $_POST['password'];
                $pass2 = $_POST['confirmPassword'];
                if ($pass1 === $pass2) {
                    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    // validate phone number
                    if (preg_match($phoneRegex, $_POST['phone'])) {
                        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    } else {
                        $data = [
                            "message" => "Phone number is invalid",
                            "status" => 400
                        ];
                    }

                    // Add to database
                    $sql = "INSERT INTO users (username, email, password, phone) VALUES ('$username', '$email',  '$hashed_password', '$phone')";

                    if ($conn->query($sql) === TRUE) {
                        // on success, redirect
                        // header('Location: login.php');
                        $data = [
                            "message" => "Login successful",
                            "status" => 200
                        ];
                    } else {
                        // on error
                        $data = [
                            "message" => "Couldn't create user",
                            "status" => 400
                        ];
                        // echo '<script>alert("error")</script>';
                        // echo "Error: ${mysqli_error($conn)}";
                    }
                } else {
                    $data = [
                        "message" => "Password does not match",
                        "status" => 400
                    ];
                };
            } else {
                $data = [
                    "message" => "Password not accepted, please follow syntax; <br/> <b>password is case sensitive, at least 6 characters long </b>",
                    "status" => 400
                ];
            }
        }
    } else {
        $data = [
            "message" => "Email is invalid",
            "status" => 400
        ];
    }

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}
