
//var index = 0;
function star_rate(item) {
    
    var count = item.id[0];
    var subid = item.id.substring(1);
    for (var i = 0; i < 5; i++) {
        if (i < count) {
            document.getElementById((i + 1) + subid).style.color = "goldenrod";
            
        } else {
            document.getElementById((i + 1) + subid).style.color = "grey";
  
        }
    }
}

function save_2_DB(num){

    $.ajax({
        type: 'POST',
        url: 'includes/review-helper.php',
        data: {'rating':num},
        async: true
    });
}
