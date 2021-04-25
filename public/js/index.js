

$('.carousel').carousel();


function callSideMenu(){
    $("#small-screen-menu-section").show();
}


function closeSideMenu(){
    $("#small-screen-menu-section").hide();
}




function validateEmail($email) {
    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    return emailReg.test( $email );
}

function sendMsg(){
  

    var email = $("#email").val();
    var msg = $("#msg").val();
    var proDate = new Date();
    var datePost = proDate.toString();

    if(email != ""){
        if(validateEmail(email)){
            if(msg != ""){

                $("#send-btn-text").hide();
                $("#send-btn-loader").show();

                $.ajax({
                    url: 'http://localhost/simplicity/msg.php',
                    type: "POST",
                    data: {
                        email: email,
                        msg: msg,
                        date_of_posting: datePost
                    },
                    timeout: 10000,
                    crossDomain: true,
                    //dataType: "json",
                    success: function (response) {
                       // console.log(response);
                        if(response == 1){
                            $("#alert-msg").show();
                            $("#send-btn-loader").hide();
                            $("#send-btn-text").show();
                            $("#email").val('');
                            $("#msg").val('');
                        }else{
                            $("#send-btn-loader").hide();
                            $("#send-btn-text").show();
                            alert('Something went wrong, try again later');
                        }
                    },
                    error: function (xhr, status) {
                       // console.log(xhr);
                        alert("Error Occured, try again", xhr);
                        $("#send-btn-loader").hide();
                        $("#send-btn-text").show();
                    }
                });

            }else{
                alert("Enter your message");
            }
        }else{
            alert('Enter a valid email address');
        }
    }else{
        alert('Enter your email address');
    }
    
   
}


$(window).on('load', function() {
	/*------------------
		Preloder
    --------------------*/
    setTimeout(function(){
        $(".loader").fadeOut(); 
	    $("#preloder").delay(400).fadeOut("slow");
    }, 3000);
	

});
