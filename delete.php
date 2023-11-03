<?php 
    $username = $_REQUEST['fileUser'];
    $filename = $_REQUEST['fileName'];
    $full_path = sprintf("/home/smnyota/protected/%s/%s", $username, $filename);

//Found the unlinkfunction on https://www.geeksforgeeks.org/deleting-all-files-from-a-folder-using-php/
    if(is_file($full_path)) {
        unlink($full_path); 
        header('Location: main.php');
    } else {
        echo "File Does Not Exist!";
        echo "<br/>";
        echo '<a href="main.php">Back to the Main Page!</a>';
    }
?>

