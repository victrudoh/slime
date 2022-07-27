<?php

session_start();
include './config/database.php';

// instantiate all variables at once
$username = $title = $description = $doc = ''; //$doc is for image
$usernameErr = $titleErr = $descriptionErr = $imageErr = '';

// on submit
if (isset($_POST['submit'])) {

    // validate name
    if (empty($_POST['username'])) {
        $usernameErr = 'Username is required';
    } else {
        $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    // validate title
    if (empty($_POST['title'])) {
        $titleErr = 'Title is required';
    } else {
        $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    // validate description
    if (empty($_POST['description'])) {
        $descriptionErr = 'Description is required';
    } else {
        $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    // **IMAGE UPLOAD SECTION** //
    // validate image
    if (empty($_FILES['image']['name'])) {
        $imageErr = 'Image is required';
    } else {
        $errors = [];
        // image description
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $img_data = $_FILES['image']['tmp_name'];
        $img_type = $_FILES['image']['type'];

        // check if the file size exceed the allocated file size limit
        if ($img_size > 31457280) {
            $errors = 'File size must be less than 30 MB';
            $_SESSION['message'] =
                '<div class="alert outline-alert alert-warning" role="alert"><strong>Error!</strong> File size must be less than 30 MB</div>';
            echo '<script> window.history.back()</script>';
            exit();
        }

        $doc = rand(001, 900) . $img_name;
        $desired_dir = './uploads';

        if (empty($errors) == true) {
            // Create directory if it does not exist
            if (is_dir($desired_dir) == false) {
                mkdir("$desired_dir", 0700);
            }
            // Move the uploaded file to the right directory
            if (is_dir("$desired_dir/" . $doc) == false) {
                move_uploaded_file($img_data, './uploads/' . $doc);
            }
            //rename the file if another one exist
            else {
                $new_dir = './uploads' . $doc . time();
                rename($img_data, $new_dir);
            }

            // Allow certain file formats 
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

            // Add to database
            $sql = "INSERT INTO post (username, title, description, image) VALUES ('$username', '$title',  '$description', '$doc')";

            if ($conn->query($sql) === TRUE) {
                // on success, redirect
                header('Location: index.php');
            } else {
                // on error
                echo '<script>alert("error")</script>';
                echo "Error: ${mysqli_error($conn)}";
            }
        } else {
            $_SESSION['message'] =
                '<div class="alert outline-alert alert-warning" role="alert"><strong>Error!</strong> File uploaded is corrupted, check and upload again</div>';

            $conn->close();
        }
    }
}
