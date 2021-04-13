<?php 

include 'dbhandler.php';

$id = $_GET['id'];
$sqlAvg = "SELECT AVG(ratingnum) AS AVGRATE FROM reviews WHERE itemid='$id'";
$sqlCount = "SELECT count(ratingnum) AS Total FROM reviews WHERE itemid='$id';";

$query = mysqli_query($conn, $sqlAvg);
$query2 = mysqli_query($conn, $sqlCount);

$row = mysqli_fetch_array($query);
$row2 = mysqli_fetch_array($query2);

$avg = round($row['AVGRATE'], 1);

echo'
<div class="container" style="text-align: center;">
    <h1>'.$avg.'</h1>
    <div class="container" style="margin-bottom: 10px;">'.stars($avg).'</div>
    <p>Number of ratings: '.round($row2['Total'], 1).'</p>
</div>
';


//we could use something like this to create the discussion board functionality. it essentially 
function stars($av){
    $s = "";
    if ($av == 0) {
        for ($i=0; $i < 5; $i++) { 
            $s .= '<i class="fa fa-star fa-2x" style="color:grey"></i>';
        }  
    }
    for ($i=0; $i < floor($av); $i++) { 
        $s .= '<i class="fa fa-star fa-2x" style="color:goldenrod"></i>';
    }
    if (($av - floor($av)) > 0.4) {
        $s .= '<i class="fas fa-star-half fa-2x" style="color:goldenrod"></i>';
    }
    return $s;
}