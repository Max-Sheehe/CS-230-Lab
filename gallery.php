<?php
require 'includes/header.php';
?>
<main>
    <link rel="stylesheet" href="css/gallery.css">

    <h1>Gallery</h1>
    <div class="gallery-container">
        <?php
            include_once 'includes/dbhandler.php';          //allows us to grab gallery contents from database
            $sql = "SELECT * FROM gallery ORDER BY upload_date DESC";        //no need to check sql since user doesnt do it
            $query = mysqli_query($conn, $sql);
            
            while($row = mysqli_fetch_assoc($query)){       //while there is a row in gallery that hasnt been pulled
                //make a gallery card
                
                //note that the '. and .' in statements like '.$row["picpath"].' allow us to concatonate onto thefile path
                echo '
                <div class = "card">
                <a href="review.php?id='.$row['pid'].'">
                    <img src="gallery/'.$row["picpath"].'">
                    <h3>'.$row["title"].'</h3>              
                    <p>'.$row["descript"].'</p>
                </a>
           </div>
                ';
            }
        ?>
    </div>



   
         
   

</main>