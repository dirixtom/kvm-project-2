$(document).ready(function(){
    $("#upload").click( function(){
		setTimeout(
			window.location = "pages/record.php"
		, 300);
    });
    
    $(".stem").click( function(e){
        var video_id = $(this).parents(".right-actions").siblings(".video_id").html();
        console.info("the id of this video is "+video_id);
        
        $.ajax({
            type:"POST",
            url:"./ajax/ajaxStem.php",
            data:{"video_id" : video_id},
            dataType:"html"
        }).done(function(response){
            var feedback = JSON.parse(response); // want om één of andere reden weigert hij het zelf juist te lezen.
            console.log(feedback.code);
            console.log(feedback.count);
            console.log(feedback.boolean);
            if( feedback.code == 500){
                console.log("something went wrong");
            }
            if( feedback.code == 200){
                console.log("everything is perfect");
            }
        });
        
        e.preventDefault();
    });
    
});
