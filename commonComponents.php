<?php
        //  
        session_start();
        if (!array_key_exists("userName", $_SESSION)) {
            //if the user is not logged in they are unable to view any files and thus are redirected to the main.php page
            header("Location: main.php");
            exit;
        }
        $username = $_REQUEST['fileUser'];
        $filename = $_REQUEST['fileName'];
        $full_path = sprintf(**, $username, $filename);
        // Now we need to get the MIME type (e.g., image/jpeg).  PHP provides a neat little interface to do this called finfo.
        $finfo = new finfo(FILEINFO_MIME_TYPE);
        $mime = $finfo->file($full_path);
        // Finally, set the Content-Type header to the MIME type of the file, and display the file.
        header("Content-Type: ".$mime);
        header('content-disposition: inline; filename="'.$filename.'";');
        readfile($full_path);
    