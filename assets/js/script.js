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
})


});



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