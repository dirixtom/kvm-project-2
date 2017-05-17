$(document).ready(function(){
    var video = document.querySelector('video');
    video.play();
    
    var klik_pause = 0;
    
    var muted = localStorage.getItem("muted");
    console.log(muted);
    if(muted === "true"){
        console.log("sound muted by default");
        var klik_mute = 1;
        video.muted=true;
    } else if(muted === "false") {
        console.log("sound isn't muted");
        var klik_mute = 2;
        video.muted=false;
    } else {
        console.log("no mute memory");
        var klik_mute = 0;
    }
    
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
    
    function checkMute(){
    }
    
    $("#mute").click(function(e){
        klik_mute++;
        if(klik_mute % 2 == 0){
            console.log("unmute");
            video.muted=false;
            localStorage.setItem("muted", false);
        } else {
            console.log("mute");
            video.muted=true;
            localStorage.setItem("muted", true);
        }
    });
});