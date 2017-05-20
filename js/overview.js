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
    
    $(".verwijder").click(function(e){
        video_id = $(this).parents(".right-actions").siblings(".video_id").html();
        that = $(this);
        
        console.info("the id of this video is "+video_id);
        console.log("de modal gaat open");
        $("#verwijder_modal").css('display', 'inline');
        
        e.preventDefault();
    });
    
    $(".cancel_verwijder").click(function(e){
        $("#verwijder_modal").css('display', 'none');
        delete video_id;
        e.preventDefault();
    });
    
    $(".delete").click( function(e){
        console.log("het wordt verwijderd");
            
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
                console.info("video "+video_id+" was removed");
                $("#verwijder_modal").css('display', 'none');
            }
        });
        e.preventDefault();
    });
    
});
