<?php

include("../config/database.php");

echo "hello";

// if (isset($_POST['login-submit'])) {
    // echo $_POST['email'];
    // $user_email = trim($_POST['username']);
    // $user_password = trim($_POST['password']);
    // $sql = "SELECT id, user, password, email FROM tbl_users WHERE email='$user_email'";
    // $resultset = mysqli_query($this->conn, $sql) or die("database error:" . mysqli_error($this->conn));
    // $row = mysqli_fetch_assoc($resultset);
    // if (md5($user_password) == $row['password']) {
    //     echo "1";
    //     $_SESSION['user_session'] = $row['user'];
    // } else {
    //     echo "Ohhh ! Wrong Credential."; // wrong details
    // }
// }

// $params = $_REQUEST;
// $action = $params['action'] != '' ? $params['action'] : '';
// $empCls = new Employee($connString);
// switch ($action) {
//     case 'login':
//         $empCls->login();
//         break;
//     default:
//         return;
//         class Employee
//         {
//             protected $conn;
//             protected $data = array();
//             function __construct($connString)
//             {
//                 $this->conn = $connString;
//             }

//             function login()
//             {
//                 if (isset($_POST['login-submit'])) {
//                     $user_email = trim($_POST['username']);
//                     $user_password = trim($_POST['password']);
//                     $sql = "SELECT id, user, password, email FROM tbl_users WHERE email='$user_email'";
//                     $resultset = mysqli_query($this->conn, $sql) or die("database error:" . mysqli_error($this->conn));
//                     $row = mysqli_fetch_assoc($resultset);
//                     if (md5($user_password) == $row['password']) {
//                         echo "1";
//                         $_SESSION['user_session'] = $row['user'];
//                     } else {
//                         echo "Ohhh ! Wrong Credential."; // wrong details
//                     }
//                 }
//             }
//         }
// }
