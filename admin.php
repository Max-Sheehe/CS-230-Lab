<?php
require 'includes/header.php';
require 'includes/dbhandler.php';
?>

<main>
    <link rel="stylesheet" href="css/profile.css">

    <script>
    function triggered() {
        document.querySelector("#gallery-image").click();
    }

    function preview(e) {
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector("#gallery-display").setAttribute('src', e.target.result);
            }
            reader.readAsDataURL(e.files[0]);
        }
    }
    </script>

    <!--
    following code prevents people from acessing things without being logged in 
-->
    <?php          //tag for php code. nice thing you can do, lots of nested structures
if (isset($_SESSION['uid'])){       //if logged in
    ?>
    <div class="h-50 center-me text-center">
        <div class="my-auto">
            <form action="includes/gallery-helper.php" method="POST" enctype="multipart/form-data">
                <!--allows us to change pfp, hence cuirrent enctype-->
                <div class="form-group">
                    <!--displays photo gotten earlier. triggers indicated block-->
                    <img src="images/default.jpg" alt="profile pic" onclick="triggered();" id="gallery-display">
                    
                    <input type="text" name="title" class="form-control" placeholder="title">

                    <!--ask mike what this does-->
                    <input type="file" name="gallery-image" id="gallery-image" onchange="preview(this)" class="form-control" style="display: none">
                </div>
                <div class="form-group">        
                    <textarea name="descript" id="bio" cols="30" rows="10" placeholder="Description" style="text-align: center"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" name="gallery-submit" class="btn btn-outline-info btn-lg btn-block">upload</button>
                </div>
            </form>
        </div>
    </div>

    <?php
}


?>

</main>