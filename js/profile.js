$(document).ready(function(){
    
    $("#img").click(function(){
        $("#image").css('visibility', 'visible');
    });

    $("#firstname, #lastname, #email").blur(function(){
        if(e.keyCode==13){
            
        var lastname = $("#lastname").val()
        var email = $("#email").val()
        
        alert(firstname + lastname + email);
            
        $.ajax({
        method: "POST",
        url: "classes/User.php",
        data: {firstname: firstname, lastname: lastname, email: email}
        }).done(function(response){
            //alert("DONE");
        });
        }
    });
});