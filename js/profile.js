$(document).ready(function(){
    
    $("#img").click(function(){
        $("#image_modal").css('display', 'inline');
    });
    
    $("#cancel_img").click(function(e){
        $("#image_modal").css('display', 'none');
        
        e.preventDefault();
    });

    $("#firstname").blur(function(){
            
        var firstname = $("#firstname").val();
        
        console.log(firstname);
            
        $.ajax({
        method: "POST",
        url: "ajax/ajaxProfile.php",
        data: {firstname: firstname}
        }).done(function(response){
            if( response.code == 500){
                console.log("ALLES IS VERKEERD");
            }
            if( response.code == 200){
                console.log("update!");
            }
        });
    });
    
    $("#lastname").blur(function(){
            
        var lastname = $("#lastname").val();
        
        console.log(lastname);
            
        $.ajax({
        method: "POST",
        url: "ajax/ajaxProfile.php",
        data: {lastname: lastname}
        }).done(function(response){
            if( response.code == 500){
                console.log("ALLES IS VERKEERD");
            }
            if( response.code == 200){
                console.log("update!");
            }
        });
    });
    
    $("#email").blur(function(){
            
        var email = $("#email").val();
                
        console.log(email);
            
        $.ajax({
        method: "POST",
        url: "ajax/ajaxProfile.php",
        data: {email: email}
        }).done(function(response){
            if( response.code == 500){
                console.log("ALLES IS VERKEERD");
            }
            if( response.code == 200){
                console.log("update!");
            }
        });
    });
    
    /*
    $("#image").change(function(){
                   
        console.log("image ajax call");
        
        var data = new FormData();
    
        $.ajax({
            url: 'ajax/ajaxProfile.php',
            type: 'POST',
            cache: false,
            data: data,
            processData: false,
            contentType: false,
            beforeSend: function () {
                console.log("Uploading, please wait....");
            },
            success: function () { 
                console.log("Upload success.");
            },
            complete: function () {
                console.log("upload complete.");
            },
            error: function () {
                console.log("ERROR in upload");
            }
        });
    });
    */
    
    $("#verwijder").click(function(e){
        $("#verwijder_modal").css('display', 'inline');
        
        e.preventDefault();
    });
    
    $("#cancel_verwijder").click(function(e){
        $("#verwijder_modal").css('display', 'none');
        
        e.preventDefault();
    });
    
});