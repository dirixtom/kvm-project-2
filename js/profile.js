$(document).ready(function(){
    
    $("#img").click(function(){
        $(".image").css('visibility', 'visible');
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
                alert("ALLES IS VERKEERD");
            }
            if( response.code == 200){
                alert("update!");
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
                alert("ALLES IS VERKEERD");
            }
            if( response.code == 200){
                alert("update!");
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
                alert("ALLES IS VERKEERD");
            }
            if( response.code == 200){
                alert("update!");
            }
        });
    });
    
});