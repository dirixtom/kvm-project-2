$(document).ready(function(){
    
    $("#img").click(function(){
        $(".image").css('visibility', 'visible');
    });

    $("#firstname, #lastname, #email, #image").blur(function(){
        if(e.keyCode==13){
            
        var fistname = $("#firstname").val()
        var lastname = $("#lastname").val()
        var email = $("#email").val()
            
        $.ajax({
        method: "POST",
        url: "classes/User.php",
        data: {firstname: firstname, lastname: lastname, email: email}
        }).done(function(response){
            //alert("DONE");
        });
        }
    });
    
    /*$("#image").on('change', function() {
        
        alert("yup");
        
        var formData = new FormData();
        
        var image = image.file;
        
        formData.append('image', image, image.name);
        
        var xhr = new XMLHttpRequest();
        
        xhr.open('POST', 'User.php', true);
        
        xhr.onload = function () {
            if (xhr.status === 200) {
            // File(s) uploaded.
            uploadButton.innerHTML = 'Upload';
        } else {
            alert('An error occurred!');
        }
        };
        
        xhr.send(formData);
    });*/
});