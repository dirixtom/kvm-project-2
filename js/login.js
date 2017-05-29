$(document).ready(function(){
    
    $("#wachtwoord").click(function(e){
        $("#wachtwoord_modal").css('display', 'inline');
        
        e.preventDefault();
    });
    
    $("#cancel_wachtwoord").click(function(e){
        $("#wachtwoord_modal").css('display', 'none');
        $("#key_modal").css('display', 'none');
        
        e.preventDefault();
    });
    
    $("#key").click(function(e){
        var email = $("#email").val();
        console.log("email posted")
        console.log(email);
        
        $.ajax({
            type:"POST",
            url:"../ajax/ajaxReset.php",
            data:{"email" : email},
            dataType:"html"
        }).done(function(response){
            var feedback = JSON.parse(response); // want om één of andere reden weigert hij het zelf juist te lezen.
            if( feedback.code == 500){
                var message = feedback.message;
                console.log("something went wrong");
                $("#wachtwoord_modal p").text(message);
                $("#wachtwoord_modal p").css("color","red");
            }
            if( feedback.code == 200){
                console.log("success");
                $("#key_modal").css('display', 'inline');
            }
        });
        
        e.preventDefault();
    });
    
    $("#reset").click(function(e){
        var code = $("#code").val();
        var email = $("#email").val();
        console.log("code posted")
        console.log(code);
        
        $.ajax({
            type:"POST",
            url:"../ajax/ajaxResetKey.php",
            data:{"code" : code, "email" : email},
            dataType:"html"
        }).done(function(response){
            var feedback = JSON.parse(response); // want om één of andere reden weigert hij het zelf juist te lezen.
            if( feedback.code == 500){
                var message = feedback.message;
                console.log("something went wrong");
                $("#key_modal p").text(message);
                $("#key_modal p").css("color","red");
            }
            if( feedback.code == 200){
                console.log("success");
                window.location = "reset.php";
            }
        });
        
        e.preventDefault();
    });
    
});