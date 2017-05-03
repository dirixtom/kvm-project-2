$(document).ready(function(){
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        video.src = window.URL.createObjectURL(stream);
        video.play();
    });
    }
    
    $("#record").click( function(){
        alert("AAAAAAAAAAAA");
    });
});