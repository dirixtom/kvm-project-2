$(document).ready(function(){
    
    $("#wachtwoord").click(function(e){
        $("#wachtwoord_modal").css('display', 'inline');
        
        e.preventDefault();
    });
    
    $("#cancel_wachtwoord").click(function(e){
        $("#wachtwoord_modal").css('display', 'none');
        
        e.preventDefault();
    });
});