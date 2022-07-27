<?php

include './config/database.php';

$id = '';

if (isset($_POST['delete'])) {

    if (empty($_POST['id'])) {
        echo "Cannot delete, nothing was selected";
    } else {
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

        // Add to database
        $sql = "DELETE FROM post WHERE id = $id";

        if ($conn->query($sql) === TRUE) {
            // on success, redirect
            header('Location: index.php');
        } else {
            // on error
            echo '<script>alert("error")</script>';
            echo "Error: ${mysqli_error($conn)}";
        }
    }
}
