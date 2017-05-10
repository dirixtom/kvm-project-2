$(document).ready(function(){
    
    var video = document.getElementById('video');
    
    if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
        video.src = window.URL.createObjectURL(stream);
        video.play();
    });
    }
    
    //browser chrome of firefox?
    function getBrowser(){
        var nAgt = navigator.userAgent;
        var browserName  = navigator.appName;
        var fullVersion  = ''+parseFloat(navigator.appVersion);
        var majorVersion = parseInt(navigator.appVersion,10);
        var verOffset,ix;
        
        if ((verOffset=nAgt.indexOf("Chrome"))!=-1) {
         browserName = "Chrome";
         fullVersion = nAgt.substring(verOffset+7);
        }
        
        else if ((verOffset=nAgt.indexOf("Firefox"))!=-1) {
         browserName = "Firefox";
         fullVersion = nAgt.substring(verOffset+8);
        }
        
        if ((ix=fullVersion.indexOf(";"))!=-1)
           fullVersion=fullVersion.substring(0,ix);
        if ((ix=fullVersion.indexOf(" "))!=-1)
           fullVersion=fullVersion.substring(0,ix);

        majorVersion = parseInt(''+fullVersion,10);
        if (isNaN(majorVersion)) {
         fullVersion  = ''+parseFloat(navigator.appVersion);
         majorVersion = parseInt(navigator.appVersion,10);
        }
        return browserName;
    }
    
    console.info("deze browser is "+getBrowser());
    
    var recording = false;
            
    if(getBrowser() == "Chrome"){
        var constraints = {"audio": true, "video": {  "mandatory": {  "minWidth": 640,  "maxWidth": 640, "minHeight": 480,"maxHeight": 480 }, "optional": [] } };//Chrome
    }else if(getBrowser() == "Firefox"){
        var constraints = {audio: true,video: {  width: { min: 640, ideal: 640, max: 640 },  height: { min: 480, ideal: 480, max: 480 }}}; //Firefox
    }
            
    var data = document.querySelector('#data');
    var downloadLink = document.querySelector('a#downloadLink'); //tijdelijk!!!
    
    video.controls = false;
    
    function errorCallback(error){
        console.log('navigator.getUserMedia error: ', error);	
    }
            
    var mediaRecorder;
    var chunks = [];
    var count = 0;
    
    //magische voodoo magie die ik zelf maar half begrijp:
    function startRecording(stream) {
        console.log('Start record functie');
        if (typeof MediaRecorder.isTypeSupported == 'function'){
            if (MediaRecorder.isTypeSupported('video/webm;codecs=h264')) {
              var options = {mimeType: 'video/webm;codecs=h264'};
            } else if (MediaRecorder.isTypeSupported('video/webm;codecs=vp9')) {
              var options = {mimeType: 'video/webm;codecs=vp9'};
            } else if (MediaRecorder.isTypeSupported('video/webm;codecs=vp8')) {
              var options = {mimeType: 'video/webm;codecs=vp8'};
            }
            console.log('Using '+options.mimeType);
            mediaRecorder = new MediaRecorder(stream, options);
        }else{
            console.log('Using default codecs for browser');
            mediaRecorder = new MediaRecorder(stream);
        }

        mediaRecorder.start(10);

        var url = window.URL || window.webkitURL;
        video.src = url ? url.createObjectURL(stream) : stream;
        video.play();

        mediaRecorder.ondataavailable = function(e) {
            chunks.push(e.data);
        };

        mediaRecorder.onerror = function(e){
            console.log('Error: ' + e);
            console.log('Error: ', e);
        };

        mediaRecorder.onstart = function(){
            console.log('Started & state = ' + mediaRecorder.state);
        };

        mediaRecorder.onstop = function(){
            console.log('Stopped  & state = ' + mediaRecorder.state);

            var blob = new Blob(chunks, {type: "video/webm"});
            console.info("1 dit is de blob: "+JSON.stringify(blob));
            chunks = [];
    
            var videoURL = window.URL.createObjectURL(blob);

            downloadLink.href = videoURL;
            video.src = videoURL;
            downloadLink.innerHTML = 'Download video file';

            var rand =  Math.floor((Math.random() * 10000000));
            var name  = "video_"+rand+".webm" ;

            downloadLink.setAttribute( "download", name);
            downloadLink.setAttribute( "name", name);
            
            console.info("2 dit is de blob: "+JSON.stringify(blob));

            //START AJAX
            
            var reader = new FileReader();
            reader.onload = function(event){
                var fd = new FormData();
                fd.append('fname', name);
                fd.append('data', event.target.result);
                $.ajax({
                    type: "POST",
                    url: "../ajax/ajaxUpload.php",
                    data: fd,
                    processData: false,
                    contentType: false
                }).done(function(data) {
                       console.log(data);
                });
            };
            reader.readAsDataURL(blob);
            // EIND AJAX
            
            function setValue(){
                document.fileform.upload.value = 100;
                document.forms["fileform"].submit();
            }

        };

        mediaRecorder.onwarning = function(e){
                    console.log('Warning: ' + e);
        };
        }
            
    $("#record").click( function(){
        
        if(recording == false ){
            console.log("recording now");
        
            $("#record").text("stop");
            recording = true;
            
            if (typeof MediaRecorder === 'undefined' || !navigator.getUserMedia) {alert('MediaRecorder not supported on your browser, use Firefox 30 or Chrome 49 instead.');
            } else {
                navigator.getUserMedia(constraints, startRecording, errorCallback);
	       }
        } else {
            mediaRecorder.stop();
            video.controls = true;
            
            console.log("recording stopped");
        }
        
    });
});