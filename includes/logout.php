<?php
session_start();
session_unset();            //essentioally same as $_SESSION = array();
session_destroy();          //removes all files from temp directory
header("Location: ../index.php");
exit();