$(document).ready(function(){
    var video = document.querySelector('video');
    video.play();
    
    var klik = 0;
    
    $("#pause").on('click', function(click){
        klik++;
        if(klik % 2 == 0){
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
});