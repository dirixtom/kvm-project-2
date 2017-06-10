$(document).ready(function(){
    var channel = "PerzianX7"; // pas dit aan om een andere stream te tonen
    
    $("#twitch").html("<iframe src='http://player.twitch.tv/?channel="+channel+"&muted=true' height='360' width='570' frameborder='0' scrolling='no' allowfullscreen='false'> </iframe>");
    
    $(document).bind('keyup', function(e){
    if(e.which==65) {
      window.location = "live_alt.php";
    }
    });

});