<?php

require 'dbhandler.php';
session_start();

define('KB', 1024);     //defining a unit that holds an int value
define('MB', 1048576); //bytes in a megabyte

if(isset($_POST["prof-submit"]))  {          //prof-submit button pushed
    $uname = $_SESSION['uname'];            //session stores key value pairs
    $file = $_FILES['prof-image'];           //file stores all file information
    $file_name = $file['name'];             //note: right side on these is not something you define. non negotioable
    $file_tmp_name = $file['tmp_name'];
    $file_error = $file['error'];
    $file_size = $file['size'];

    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $allowed = array('jpg', 'jpeg', 'png', 'svg');

    if($file_error !==0){
        header("Location: ../profile.php?error=UploadError");
        exit();
    }

    if(!in_array($ext, $allowed)){
        header("Location: ../profile.php?error=InvalidType");
        exit();
    }

    if($file_size > 4*MB){
        header("Location: ../profile.php?error=FileSizeTooLarge");
        exit();
    }

    else{
        $new_name = uniqid('', true).".".$ext;          //gives a name to the file
        $destination = '../profiles/'.$new_name;

        $sql = "UPDATE profiles SET profpic='$destination' WHERE uname='$uname'";

        mysqli_query($conn, $sql);

        move_uploaded_file($file_tmp_name, $destination);
        header("Location: ../profile.php?success=UploadWin");
        exit();
    }

    //this just outputs the file
    print_r($file);


}else{
    header("Location: ../profile.php");
    exit();
}