$(document).ready(function(){
    
    var map = [];
onkeydown = onkeyup = function(e){
    e = e || event; // to deal with IE
    map[e.keyCode] = e.type == 'keydown';
    
    if(map[80] && map[8]){
        window.location = "pages/profile.php";
    }
    if(map[76] && map[8]){
        window.location = "pages/logout.php";
    }
    if(map[86] && map[8]){
        window.location = "pages/voorkeuren.php";
    }
}

});