$(document).ready(function(){
    
    $("#upload").click( function(){
		setTimeout(
			window.location = "pages/record.php"
		, 300);
    });
    
    $(".stem").click( function(e){
        var video_id = $(this).parents(".right-actions").siblings(".video_id").html();
        //console.info("the id of this video is "+video_id);
        var that = $(this);
        
        $.ajax({
            type:"POST",
            url:"./ajax/ajaxStem.php",
            data:{"video_id" : video_id},
            dataType:"html"
        }).done(function(response){
            var feedback = JSON.parse(response); // want om één of andere reden weigert hij het zelf juist te lezen.
            if( feedback.code == 500){
                //console.log("something went wrong");
            }
            if( feedback.code == 200){
                //console.log("everything is perfect");
                if(feedback.boolean = true){
                    that.siblings(".count").text(feedback.count);
                }
            }
        });
        
        e.preventDefault();
    });
    
    $(".delete").click( function(e){
        alert("blubbers");
        var video_id = $(this).parents(".right-actions").siblings(".video_id").html();
        console.info("the id of this video is "+video_id);
        var that = $(this);
        
        $.ajax({
            type:"POST",
            url:"./ajax/ajaxDelete.php",
            data:{"video_id" : video_id},
            dataType:"html"
        }).done(function(response){
            var feedback = JSON.parse(response); // want om één of andere reden weigert hij het zelf juist te lezen.
            if( feedback.code == 500){
                console.log("something went wrong");
            }
            if( feedback.code == 200){
                console.log("everything is perfect");
                that.parents(".video").css("display", "none");
            }
        });
        
        e.preventDefault();
    });
    
});
