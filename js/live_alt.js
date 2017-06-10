$(document).ready(function(){
    
    var video = document.querySelector('video');
    video.play();
    
    var data = $("#data").text();
    var dataArray = data.split(";");
    
    aantal = dataArray.length;
    var i = 1;
    video.src = "../uploads/videos/"+dataArray[0];
    video.play();
    video.onended = function(e) {
        video.src = "";
        setTimeout(function(){
            video.src = "../uploads/videos/"+dataArray[i++ % aantal];
            video.load();
            video.play();
        }, 2000);
    }
});