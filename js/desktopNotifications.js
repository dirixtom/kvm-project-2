$(document).ready(function(){
    function melding(boodschap, pad) {
      if (Notification.permission !== "granted"){
        Notification.requestPermission();
        
        var notification = new Notification('kvm Fancorder', {
          icon: 'http://www.kvmechelen.be/wp-content/uploads/2017/02/kv-mechelen-logo.png',
          body: boodschap,
        });

        notification.onclick = function () {
          window.open("http://localhost/project/kvm-project-2/"+pad);      
        };
        
      } else {
        var notification = new Notification('kvm Fancorder', {
          icon: 'http://www.kvmechelen.be/wp-content/uploads/2017/02/kv-mechelen-logo.png',
          body: boodschap,
        });

        notification.onclick = function () {
          window.open("http://localhost/project/kvm-project-2/"+pad);      
        };

      }

    }
    
    var nummer = parseInt($(".nummer").text());
    if(isNaN(nummer)){
        nummer = 0;
    }
    console.log(nummer);
    var pad = $(".pad").last().attr('href');
    var boodschap = $(".boodschap").last().text();
    
    var lastNummer = localStorage.getItem("nummer");
    console.log(lastNummer);
    
    if(nummer > lastNummer){
    
    if(nummer == 0){
        console.log("geen nieuwe melding");
    } else if(nummer == 1){
        melding(boodschap, pad);
    } else if(nummer > 1){
        melding("er zijn "+nummer+" nieuwe meldingen", "index.php");
    }
        
    }
    
    if(isNaN(nummer) == false){
        localStorage.setItem("nummer", nummer);
    }
    if(isNaN(nummer)){
        localStorage.setItem("nummer", 0);
    }
});