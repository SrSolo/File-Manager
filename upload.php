<?php
    session_start();
    if (!array_key_exists("userName", $_SESSION)) {
        header("Location: main.php");
        exit;
    }

    // Get the filename and make sure it is valid
    $filename = basename($_FILES['uploadedfile']['name']);
    if(!preg_match('/^[\w_\.\-]+$/', $filename) ){
        echo "Invalid filename";
        exit;
    }

    // Get the username and make sure it is valid
    $username = $_SESSION['userName'];
    if( !preg_match('/^[\w_\-]+$/', $username) ){
        echo "Invalid username";
        exit;
    }
    
    $full_path = sprintf("**", $username, $filename);

    if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path)){
        header("Location: goodUpload.html");

    }else{
        header("Location: failedUpload.html");
    }
?>

