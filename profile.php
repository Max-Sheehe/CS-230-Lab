<?php
require 'includes/header.php';
require 'includes/dbhandler.php';
?>

<main>
    <link rel="stylesheet" href="css/profile.css">

    <script>
    function triggered() {
        document.querySelector("#prof-image").click();
    }

    function preview(e) {
        if (e.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector("#prof-display").setAttribute('src', e.target.result);
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
    //usernamer after login
    $prof_user = $_SESSION['uname'];
    $sqlpro = "SELECT * FROM profiles WHERE uname='$prof_user';";           //note double semicolon
    $res = mysqli_query($conn, $sqlpro);            //stores result of sql from the db above
    $row = mysqli_fetch_array($res);                //stores array from the result
    $photo = $row['profpic'];                       //gets given users profile pic
 
    ?>
    <div class="h-50 center-me text-center">
        <div class="my-auto">
            <form action="includes/upload-helper.php" method="POST" enctype="multipart/form-data">
                <!--allows us to change pfp, hence cuirrent enctype-->
                <div class="form-group">
                    <!--displays photo gotten earlier. triggers indicated block-->
                    <img src="<?php echo $photo;?>" alt="profile pic" onclick="triggered();" id="prof-display">
                    <label for="prof-image" id="uname-style"><?php echo $prof_user?></label>
                    <!--ask mike what this does-->
                    <input type="file" name="prof-image" id="prof-image" onchange="preview(this)" class="form-control" style="display: none">
                </div>
                <div class="form-group">
                    <textarea name="bio" id="bio" cols="30" rows="10" placeholder="bio..." style="text-align: center"></textarea>
                </div>
                <div class="form-group">
                    <button type="submit" name="prof-submit" class="btn btn-outline-info btn-lg btn-block">upload</button>
                </div>
            </form>
        </div>
    </div>

    <?php
}


?>

</main>