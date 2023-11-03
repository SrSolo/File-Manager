<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Sharing Site</title>
        <link rel='stylesheet' href='main.css'>
    </head>
    <body>
    <h1>WashU CSE 330 File Sharing Site!</h1>
    <div class = "header">
    </div>
    <?php 
        if (array_key_exists("userName", $_SESSION)) {
            $username = $_SESSION['userName'];
            echo "<h2>Welcome Back: ".htmlentities($_SESSION['userName'])."</h2>";
            echo '
                  <form action="logout.php">
                  <input type="submit" name="logout" value="Logout">
                  </form>

                  <h2>
                  Your Files:
                  </h2> 
                 ';
                 $fileName = "";
                 $full_path = sprintf("**", $username);
                 $files = glob($full_path);
                 foreach($files as $file) {
                     echo "<br/>";
                     $infoFile = pathinfo($file);
                     $fileName = $infoFile['basename'];
                     echo 'File Name: '.htmlentities($fileName);
                     echo "<br/>";
                     echo '
                     <form enctype="multipart/form-data" action="commonComponents.php" method="get">
                         <p>
                             <input type="hidden" name="fileUser" value="'.htmlentities($username).'">
                             <input type="hidden" name="fileName" value="'.htmlentities($fileName).'">
                             <input type="submit" name="submit" value="View File"/>
                         </p>
                     </form>
                     <form enctype="multipart/form-data" action="delete.php" method="get">
                        <p>
                            <input type="hidden" name="fileUser" value="'.htmlentities($username).'">
                            <input type="hidden" name="fileName" value="'.htmlentities($fileName).'">
                            <input type="submit" name="submit" value="Delete File"/>
                        </p>
                     </form>
                          ';
                 }
                //Upload file here
                 echo '
                 <hr>
                 <form enctype="multipart/form-data" action="upload.php" method="POST">
                         <input type="hidden" name="MAX_FILE_SIZE" value="20000000"/> 
                         <h3>Choose a file to upload:</h3><br>
                         <input name="uploadedfile" type="file" id="uploadfile_input"/>
                     <p>
                         <input type="submit" value="Upload File"/>
                     </p>
                 </form>
                     ';
                 //enter a text file here
                 echo '
                        <hr>
                        <h3>
                        Create a Text File From Input:
                        </h3> 
                        <form action="createFile.php" method="POST">
                            <input name="fileName" type="text" placeholder="File Name" required/> 
                            <br><br>
                            <textarea name="text" placeholder="Write Here" required></textarea> 
                            <br><br>
                            <input type="submit" name="submit" value="Submit to text file">
                        </form>
                      ';

        } else {
            //Not logged in case
            echo '
                    <div class="topWrap">
                        <h1 class="welcomeMessage">Special Shoutout to Professor:</h1>
                        <div class="name-list">
                            <ul class="ul">
                                <li>Sproull</li>
                                <li>Siever</li>
                                <li>Shidal</li>
                                <li>Cytron</li>
                            </ul>
                        </div>
                    </div>
                ';
            echo '
                <div class="userParent">
                <div class="userChild">
                <h2>Login!</h2>
                <form action="login.php">
                    <label>User Name:</label><br>
                    <input type="text" name="userName" placeholder="joe" required><br>
                    <input type="submit" name="submit" value="Login">
                </form> 
                </div>
                <div class="userChild">
                <h2>Create an Account!</h2>
                <form action="signup.php">
                    <label>User Name:</label><br>
                    <input type="text" name="userName" placeholder="joe" required><br>
                    <input type="submit" name="submit" value="SignUp">
                </form> 
                </div>
                </div>
                 ';
        }
    ?>
    </body>
</html>