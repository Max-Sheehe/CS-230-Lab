<?php 
require 'includes/dbhandler.php';
require 'includes/header.php'; 
require 'includes/review-helper.php';
?>

<main>
    <span id="testAvg"></span>
    <div class="container" align="center" style="max-width: 800px;">
        <div class="my-auto">
            <!--taking info from a user, do with it what you will. we set it up to give acess to $_POST global variable in review-helper. php (as specified)-->
            <form id="review-form" action="includes/review-helper.php" method="post">
                <div class="container">
                    <!--i class is for icon, fa for font awesome that we got in header.php. go to site to change icon if desired-->
                    <i class="fa fa-star fa-2x star-rev" data-index="1"></i>
                    <i class="fa fa-star fa-2x star-rev" data-index="2"></i>
                    <i class="fa fa-star fa-2x star-rev" data-index="3"></i>
                    <i class="fa fa-star fa-2x star-rev" data-index="4"></i>
                    <i class="fa fa-star fa-2x star-rev" data-index="5"></i>
                </div>
                <div class="form-group" style="margin-top: 15px;">
                    <label class="title-label" for="review-title"
                        style="font-size: 16px; font-weight: bold;">Title</label>
                    <input type="text" name="review-title" id="review-title" style="width: 100%; margin-bottom: 10px;">
                    <textarea name="review" id="review-text" cols="90" rows="3"
                        placeholder="Enter a comment..."></textarea>
                    <input type="hidden" name="rating" id="rating">
                    <!--how does this work?-->
                    <input type="hidden" name="item_id" value=<?php echo $_GET['id'];?>>
                </div>
                <div class="form-group">
                    <button class="btn btn-outline-danger" type="submit" name="review-submit" id="review-submit"
                        style="width: 100%;">Review</button>
                </div>
            </form>
        </div>

    </div>
    <span id="review_list"></span>
</main>

<script type="text/javascript">
var rateIndex = -1;
var id = <?php echo $_GET['id'];?>;
/** above code gets id from url, it was put there in gallery.php */

$(document).ready(function() {
    reset_star();

    // get reviews
    xhr_getter('display-reviews.php?id=', "review_list");
    //avg();
    xhr_getter('includes/get-ratings.php?id=', "testAvg");

    if (localStorage.getItem('rating') != null) {
        setStars(parseInt(localStorage.getItem('rating')));
    }
    $('.star-rev').on('click', function() {
        rateIndex = parseInt($(this).data('index'));
        localStorage.setItem('rating', rateIndex);
    });
    $('.star-rev').mouseover(function() {
        reset_star();
        var currIndex = parseInt($(this).data('index'));
        setStars(currIndex);

    });
    $('.star-rev').mouseleave(function() {
        reset_star();

        if (rateIndex != -1) {
            setStars(rateIndex);
        }
    });

    function setStars(max) {
        for (var i = 0; i < max; i++) {
            $('.star-rev:eq(' + i + ')').css('color', 'goldenrod');
        }
        document.getElementById('rating').value = parseInt(localStorage.getItem('rating'));
        console.log(id);
    }

    function reset_star() {
        $('.star-rev').css('color', 'grey');
    }


    //Used to interchangeably send GET requests for review display data. 
    function xhr_getter(prefix, element) {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            // If the GET request was successful, fill in the span element with the review_list id with reviews
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById(element).innerHTML = this.responseText;
            }
        };
        url = prefix + id;
        xhttp.open("GET", url, true);
        xhttp.send();
    }
});
</script>