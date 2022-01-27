var timer;


$(document).ready(function(){
    
$(".result").on("click", function() {
    console.log("I was clicked");

    var id = $(this).attr("data-linkId");
    var url = $(this).attr("href");

    console.log(id);
    if(!id){
        alert("data-linkId not found WTF"); 
    }

    increaseLinkClicks(id,url);


    return false;
});


var grid = $(".imageResults");

grid.on("layoutComplete", function(){
    $(".gridItem img").css("visibility", "visible"); // masonry func.
});

    grid.masonry({

        itemSelector: ".gridItem" ,
        columnWidth: 200,
        gutter:5,
        isInitLayout: false
       
    });
});



function loadImage(src, className){

    var image = $("<img>");

    image.on("load", function(){
        $("." + className + " a").append(image);

        clearTimeout(timer);
        timer = setTimeout(function(){
            $(".imageResults").masonry(); //samo jednom poziva kod

        }, 500);

        
    });

    image.on("error", function(){

        
    });

    image.attr("src", src);




};








function increaseLinkClicks(linkId, url){

    $.post("ajax/updateLinkCount.php", {linkId:  linkId})
    .done(function(result){

        if(result != ""){
            alert(result);
            return;
        }

        window.location.href = url ;
    });


}
