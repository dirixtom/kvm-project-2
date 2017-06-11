$(document).ready(function(){
    
    $(document).bind('keyup', function(e){
    if(e.which==80) {
      window.location = "pages/profile.php";
    }
    if(e.which==76) {
      window.location = "pages/logout.php";
    }
    if(e.which==86) {
      window.location = "pages/voorkeuren.php";
    }
    });

});