$(document).ready(function(){
    $("input").click(function(){
        //update alle instellingen
        
        if($("#pushVerkozen").is(':checked')){
            var pushVerkozen = "true";
        } else {
            var pushVerkozen = "false";
        }
        
        if($("#pushVriendUpload").is(':checked')){
            var pushVriendUpload = "true";
        } else {
            var pushVriendUpload = "false";
        }
        
        if($("#pushProfielStatus").is(':checked')){
            var pushProfielStatus = "true";
        } else {
            var pushProfielStatus = "false";
        }
        
        if($("#emailVerkozen").is(':checked')){
            var emailVerkozen = "true";
        } else {
            var emailVerkozen = "false";
        }
        
        if($("#emailVriendUpload").is(':checked')){
            var emailVriendUpload = "true";
        } else {
            var emailVriendUpload = "false";
        }
        
        if($("#emailProfielStatus").is(':checked')){
            var emailProfielStatus = "true";
        } else {
            var emailProfielStatus = "false";
        }
        
        $.ajax({
        method: "POST",
        url: "../ajax/ajaxSettings.php",
        data: {pushVerkozen: pushVerkozen, pushVriendUpload: pushVriendUpload, pushProfielStatus: pushProfielStatus, emailVerkozen: emailVerkozen, emailVriendUpload: emailVriendUpload, emailProfielStatus: emailProfielStatus}
        }).done(function(response){
            if( response.code == 200){
                console.log("succes!");
            }
            if( response.code == 500){
                console.log("probleem");
            }
        });
    });
    
});