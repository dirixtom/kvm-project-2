$(document).ready(function(){
    
    var fnSession = $("#firstname").val();
    var lnSession = $("#lastname").val();
    var emSession = $("#email").val();
    
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
                $("#firstname").val(fnSession);
                console.log(response.message);
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
                $("#lastname").val(lnSession);
                console.log(response.message);
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
                $("#email").val(emSession);
                console.log(response.message);
            }
        });
    });
    
    $("#verwijder").click(function(e){
        $("#verwijder_modal").css('display', 'inline');
        
        e.preventDefault();
    });
    
    $("#cancel_verwijder").click(function(e){
        $("#verwijder_modal").css('display', 'none');
        
        e.preventDefault();
    });
    
});