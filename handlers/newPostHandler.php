<?php


session_start();
include '../config/database.php';

if (isset($_FILES['file']['name'])) {

    // instantiate all variables at once
    $username = $title = $description = $doc = ''; //$doc is for image

    // validate name
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // validate title
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // validate description
    $description = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // **IMAGE UPLOAD SECTION** //
    // validate image
    if (empty($_FILES['file']['name'])) {
        $data = [
            "message" => "Image is required",
            "status" => 400
        ];
    } else {
        $errors = [];

        // image description
        $img_name = $_FILES['file']['name'];
        $img_size = $_FILES['file']['size'];
        $img_data = $_FILES['file']['tmp_name'];
        $img_type = $_FILES['file']['type'];

        // check if the file size exceed the allocated file size limit
        if ($img_size > 31457280) {
            $data = [
                "message" => "File size must be less than 30 MB",
                "status" => 400
            ];
        }

        $doc = rand(001, 900) . $img_name;
        $desired_dir = '../uploads';

        if (empty($errors) == true) {
            // Create directory if it does not exist
            if (is_dir($desired_dir) == false) {
                mkdir("$desired_dir", 0700);
            }
            // Move the uploaded file to the right directory
            if (
                is_dir("$desired_dir/" . $doc) == false
            ) {
                move_uploaded_file($img_data, '../uploads/' . $doc);
            }
            //rename the file if another one exist
            else {
                $new_dir = '../uploads' . $doc . time();
                rename($img_data, $new_dir);
            }

            // Allow certain file formats 
            $allowTypes = array('jpg', 'png', 'jpeg', 'gif');

            // Add to database
            $sql = "INSERT INTO post (username, title, description, image) VALUES ('$username', '$title',  '$description', '$doc')";

            if ($conn->query($sql) === TRUE) {
                // on success, redirect
                $data = [
                    "message" => "Added new post",
                    "status" => 200
                ];
            } else {
                // on error
                $data = [
                    "message" => "Error: ${mysqli_error($conn)}",
                    "status" => 400
                ];
            }
        } else {
            $data = [
                "message" => "<strong>Error!</strong> <br/> File uploaded is corrupted, check and upload again",
                "status" => 400
            ];
            $conn->close();
        }
    }



    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
} else {
    $data = [
        "message" => "Coudn't add post",
        "status" => 400
    ];

    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
}
