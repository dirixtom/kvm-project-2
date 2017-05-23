$(document).ready(function(){
    
    $("#upload").click( function(e){
        var tags = $("#tags").val();
        
        if(tags == ""){
            var tags = "none";
        }
        
        $.ajax({
        method: "POST",
        url: "../ajax/ajaxUpload.php",
        data: {tags: tags}
        }).done(function(response){
            if( response.code == 200){
                console.log("De video is geupload naar de databank!");
                window.location = "../index.php";
            }
            if( response.code == 500){
                console.log("er is iets misgelopen.");
            }
        });
        
        e.preventDefault();
    });
});