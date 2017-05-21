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
    
    $(".rapporteer").click(function(e){
        video_id2 = $(this).parents(".right-actions").siblings(".video_id").html();
        that = $(this);
        
        console.info("the id of this video is "+video_id2);
        console.log("de modal gaat open");
        $("#report_modal").css('display', 'inline');
        
        e.preventDefault();
    });
    
    $(".cancel_report").click(function(e){
        $("#report_modal").css('display', 'none');
        delete video_id2;
        e.preventDefault();
    });
    
    $(".report").click( function(e){
        var category = $(this).siblings(".category").val();
        var bericht = $(this).siblings(".bericht").val();
        
        console.info("category: "+category+" bericht: "+bericht);
        
        $.ajax({
            type:"POST",
            url:"./ajax/ajaxReport.php",
            data:{"video_id" : video_id2, "category": category, "bericht": bericht},
            dataType:"html"
        }).done(function(response){
            var feedback = JSON.parse(response); // want om één of andere reden weigert hij het zelf juist te lezen.
            if( feedback.code == 500){
                console.log("something went wrong");
            }
            if( feedback.code == 200){
                console.log("everything is perfect");
                that.parents(".video").css("display", "none");
                console.log(video_id2+" is gerapporteerd");
                $("#report_modal").css('display', 'none');
            }
        });
        e.preventDefault();
        
    });
    
    $("#drie").click(function(e){
        $("#meldingen").css('display', 'inline');
        
        e.preventDefault();
    });
    
    $(".melding_close").click(function(e){
        $(this).parents(".melding").css('display', 'none');
        var melding_id = $(this).siblings(".pad").children(".melding_id").html();
        var nummer = $(".nummer").html();
        nummer = nummer -1;
        $(".nummer").html(nummer);
        
        $.ajax({
            type:"POST",
            url:"./ajax/ajaxCheckNotifications.php",
            data:{"melding_id" : melding_id},
            dataType:"html"
        }).done(function(response){
            var feedback = JSON.parse(response); // want om één of andere reden weigert hij het zelf juist te lezen.
            if( feedback.code == 500){
                console.log("something went wrong");
            }
            if( feedback.code == 200){
                console.log("melding "+melding_id+" verwijderd");
            }
        });
        
        e.preventDefault();
    });
});
