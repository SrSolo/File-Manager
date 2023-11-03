<?php
//file_put_contents from: https://stackoverflow.com/questions/14998961/php-write-file-from-input-to-txt
session_start();
$username ='';
if (array_key_exists("userName", $_SESSION)) {
    $username = $_SESSION['userName'];
} else {
    //Should never enter this case as a user should not be able to create their own text file without being logged in (adding it in just in case)
    header("Location: main.php");
}

if(isset($_POST['text']) && isset($_POST['fileName']) && $_POST['submit']) {
    $data = $_POST['text']. "\r\n";
    $filename = $_POST['fileName'];
    $full_path = sprintf("**", $username, $filename);
    //I found the file_put_contents() function from the site below which explained what it does and gave examples on how to use it:
    //https://www.php.net/manual/en/function.file-put-contents.php
    $uploadedFile = file_put_contents($full_path, $data, FILE_APPEND | LOCK_EX);
    if($uploadedFile === false) {
        die('An error occured constructing the file');
    }
    else {
        //Write was successful
        header("Location: goodUpload.html");
    }
}
else {
   die('Post request not recieved');
}