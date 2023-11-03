<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel='stylesheet' href='main.css'>
    <title>Signup Page</title>
</head>
    <body>
    <?php
    // echo "<link rel='stylesheet' href='/var/www/html/fileShare.css>";
    // echo "lets start this unit";
    if (isset($_GET['submit'])) {
        $userName = $_GET['userName'];
        $full_path = sprintf("/home/smnyota/protected/%s", $userName);
        $userAlreadyExists = false;
        $users = fopen("/home/smnyota/protected/users.txt", "r"); //r means reading
        while(!feof($users) ){
            //fgets() method from CSE 330 Class page
            //trim() method from --> https://www.php.net/trim
            $verifiedUser = trim(fgets($users));
            if ($verifiedUser == $userName) {
                $userAlreadyExists = true;
            }
        }

        if ($userAlreadyExists) {
            echo '
                <h1>This user name has already been created!</h1>
                <a href="main.php"> <h2>Return Back to the Dashboard</h2></a>
                ';
        } else{
            $userFile = fopen("/home/smnyota/protected/users.txt", "a") or die("Unable to open file!");
            fwrite($userFile, "\n". $userName); //appends newly created userName to the end of the users.txt file
            fclose($userFile);
            mkdir($full_path); //creates new directory for the newly created user
            echo '
            <h1>Account successfully created!</h1>
            <a href="main.php"> <h2>Return Back to the Dashboard to login</h2></a>
            ';
        }
    }
    ?>
    </body>
</html>



