$(document).ready(function(){
    var video = document.querySelector('video');
    video.play();
    
    var klik_pause = 0;
    var klik_mute = 0;
    
    $("#pause").on('click', function(click){
        klik_pause++;
        if(klik_pause % 2 == 0){
            console.log("speel");
            video.play();
            $("#pause").text("pauzeren");
        } else {
            console.log("pauze");
            video.pause();
            $("#pause").text("afspelen");
        }
    });
    
    $("#replay").click( function(e){
        console.log("replay");
        video.currentTime = '0';
        video.play();
    });
    
    $("#mute").click(function(e){
        klik_mute++;
        if(klik_mute % 2 == 0){
            console.log("mute");
            video.muted=true;
        } else {
            console.log("unmute");
            video.muted=false;
        }
    });
});