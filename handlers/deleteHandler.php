<?php

include '../config/database.php';

$id = $image = '';

if (isset($_POST['delete'])) {

    if (empty($_POST['id'])) {
        echo "Cannot delete, nothing was selected";
    } else {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $image = filter_input(INPUT_POST, 'image', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Add to database
        $sql = "DELETE FROM post WHERE id = $id";

        $path = $_SERVER['DOCUMENT_ROOT'] . '/slime/uploads/' . $image;
        unlink($path);

        if ($conn->query($sql) === TRUE) {
            // on success, redirect
            header('Location: ../feed');
        } else {
            // on error
            echo '<script>alert("error")</script>';
            echo "Error: ${mysqli_error($conn)}";
        }
    }
}
