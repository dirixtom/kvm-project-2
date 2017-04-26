$(document).ready(function(){
    
    $("#img").click(function(){
        $(".image").css('visibility', 'visible');
    });

    $("#firstname").blur(function(){
            
        var firstname = $("#firstname").val();
                
        console.log(firstname);
            
        /*$.ajax({
        method: "POST",
        url: "classes/User.php",
        data: {firstname: firstname}
        }).done(function(response){
            //alert("DONE");
        });*/
    });
    
    $("#lastname").blur(function(){
            
        var lastname = $("#lastname").val();
        
        console.log(lastname);
            
        /*$.ajax({
        method: "POST",
        url: "classes/User.php",
        data: {lastname: lastname}
        }).done(function(response){
            //alert("DONE");
        });*/
    });
    
    $("#email").blur(function(){
            
        var email = $("#email").val();
        
        console.log(email);
            
        /*$.ajax({
        method: "POST",
        url: "classes/User.php",
        data: {email: email}
        }).done(function(response){
            //alert("DONE");
        });*/
    });
});