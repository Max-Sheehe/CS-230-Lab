<?php

require 'dbhandler.php';
session_start();

define('KB', 1024);     //defining a unit that holds an int value
define('MB', 1048576); //bytes in a megabyte

if(isset($_POST["gallery-submit"]))  {          //prof-submit button pushed
    $file = $_FILES['gallery-image'];           //file stores all file information
    $file_name = $file['name'];             //note: right side on these is not something you define. non negotioable
    $file_tmp_name = $file['tmp_name'];
    $file_error = $file['error'];
    $file_size = $file['size'];

    $title = $_POST['title'];               //how does this get from post? is this cause admin uses form action method post
    $descript = $_POST['descript'];

    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    $allowed = array('jpg', 'jpeg', 'png', 'svg');

    if($file_error !==0){
        header("Location: ../admin.php?error=UploadError");                     //crashes here. why? because of leftover photos in gallery file
        exit();
    }

    if(!in_array($ext, $allowed)){
        header("Location: ../admin.php?error=InvalidType");
        exit();
    }

    if($file_size > 4*MB){
        header("Location: ../admin.php?error=FileSizeTooLarge");
        exit();
    }

    else{
        $new_name = uniqid('', true).".".$ext;          //gives a name to the file
        $destination = '../gallery/'.$new_name;

        $sql = "INSERT INTO gallery (title, descript, picpath) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){              //check for sql injection
            header("Location: ../admin.php?errorr=SQLInjection");
            exit();
        }else{
            mysqli_stmt_bind_param($stmt, "sss", $title, $descript, $destination);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        
            move_uploaded_file($file_tmp_name, $destination);
            header("Location: ../admin.php?success=GalleryUploadComplete");
            exit();
        }

        
    }

    //this just outputs the file
    print_r($file);


}else{
    header("Location: ../admin.php");
    exit();
}