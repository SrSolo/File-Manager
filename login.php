<?php
if (isset($_GET['submit'])) {
    $userName = $_GET['userName'];
    $loggedIn = false;
    $users = fopen("/home/smnyota/protected/users.txt", "r"); //r means reading
    while(!feof($users) ){
        //fgets() method from CSE 330 Class page
        //trim() method from --> https://www.php.net/trim
        $verifiedUser = trim(fgets($users));
        if ($verifiedUser == $userName) {
            $loggedIn = true;
        }
    }

    if ($loggedIn) {
        session_start();
        $_SESSION['userName'] = $userName;
        header("Location: main.php?user=$userName");
    } else{
        header("Location: failedLogin.html");
    }
}
?>



