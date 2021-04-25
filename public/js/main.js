
var urlroot = $("#urlroot").val();

function startbtnLoader(idText, idLoader){
    $("#"+idText).hide();
    $("#"+idLoader).show();
}


function stopBtnLoader(idText, idLoader){
    $("#"+idLoader).hide();
    $("#"+idText).show();
}


function alertMsgText(id, msg){
    $("#"+id).focus();
    $("#"+id).html(msg);
}

function removeMsgAlert(id){
    $("#"+id).html('');
}



function showAlertmsg(status, msg){
    $('#alert-msg').show();
    $("#alert-status").html(status);
    $("#alert-text-title").html(msg);

    setTimeout(function(){
        $('#alert-msg').fadeOut();
    }, 3000);
}




function getCurrentQuiz(){
    $.get(urlroot + "/admins/show_current_file",
    function(data, status){
        $("#quiz-view-table").html(data);
    });
}




function processAnsFastForUser(){
    var subject = $("#subject").val();
    var year = $("#year").val();
    var paper = $("#paper").val();
    
    var alpha = ['A', 'B', 'C', 'D', 'E'];
    var quizAns = [];
    var totalQuiz = $("#total-quiz").val();
    
    for(var i = 1; i <= totalQuiz; i++){
        var selected = $("input[type='radio'][name='"+i+"']:checked").val();
        if(selected == undefined){
            selected = ' ';
        }
        quizAns.push(selected);
    }

    
    $.ajax(urlroot + '/pages/quick_process_user_result', {
        type: 'POST',  // http method
        data: { 
            subject: subject,
            year: year,
            paper: paper,
            ans: quizAns
           
         },  // data to submit
            success: function (data, status, xhr) {
               // $("#process-loader").hide();
               // $("#test-ans-body").show();
                $("#current-ans").html(data);
                $("#submit-ans-user-btn").hide();
                $("#re-take-question-user-btn").show();
            },
            error: function (jqXhr, textStatus, errorMessage) {
                    alert('Error' + errorMessage);
            }
    });
    
}



function reloadTestEnviro(){
    var paper = $("#paper").val();
    var subject = $("#subject").val();
    var year = $("#year").val();
    window.location = urlroot + '/pages/take_test/' + paper + '/' + subject + '/' + year;
}

function closeAnsBody(){
    $("#dark-bg").hide();
}



function submitAnsByUsers(){
    var quizId = $("#quiz-id").val();
    var quizName = $("#quiz-name").val();
    var alpha = ['A', 'B', 'C', 'D', 'E'];
    var quizAns = [];
    var totalQuiz = $("#total-quiz").val();

    for(var i = 1; i <= totalQuiz; i++){
        var selected = $("input[type='radio'][name='"+i+"']:checked").val();
        if(selected == undefined){
            selected = ' ';
        }
        quizAns.push(selected);
    }
    console.log(quizAns);
}




function reTakeSubmitAnsByUsers(){
    var quizId = $("#quiz-id").val();
    var quizName = $("#quiz-name").val();
    var alpha = ['A', 'B', 'C', 'D', 'E'];
    var quizAns = [];
    var totalQuiz = $("#total-quiz").val();

    for(var i = 1; i <= totalQuiz; i++){
        var selected = $("input[type='radio'][name='"+i+"']:checked").val();
        if(selected == undefined){
            selected = ' ';
        }
        quizAns.push(selected);
    }

    $.ajax(urlroot + '/users/process_user_re_take_result', {
        type: 'POST',  // http method
        data: { 
            userAns: quizAns,
            quizId: quizId
           
         },  // data to submit
            success: function (data, status, xhr) {
               // console.log(data);
                if(data == true){
                    showAlertmsg('Success', 'Your quiz answers has been submitted');
                    $("#submit-ans-user-btn").attr('disabled', true);
                }else{
                    showAlertmsg('Error', 'Re-take Quiz ??');
                }
             
            },
            error: function (jqXhr, textStatus, errorMessage) {
                    alert('Error' + errorMessage);
            }
    });
}






function loadSubject(){
    var paper = $("#paper").val();
    var subject =  $("#subject option:selected" ).val();
    var year = $("#year option:selected" ).val();

    if(subject != ""){
        if(year != ""){
            goToLocation(paper, subject, year);
        }else{
            showAlertmsg('Error', 'Select the year');
        }
    }else{
        showAlertmsg('Error', 'Select the subject');
    }

}

function goToLocation(paper, subject, year){
    window.location = urlroot + '/pages/take_test/'+ paper + '/' + subject + '/' + year;
}



function getYear(){
    var table = $("#paper").val();
    var subject = $("#subject option:selected").html();
    
    $.ajax({
        url: urlroot + "/pages/get_year",
        type: "POST",
        data: {
            table: table,
            subject: subject
        },
        crossDomain: true,
        dataType: "json",
        success: function (response) {
            var output = '';
            for (let i = 0; i < response.length; i++) {
                output += '<option value="'+response[i]+'">' + response[i] + '</option>';
            }

            $("#year").append(output);
            $("#year").removeAttr("disabled");
            
        },
        error: function (xhr, status) {
            showAlertmsg('Error', 'Something went wrong, Try again');
        }
    });
}


function toggleLink(elementId){
    $("#"+ elementId).slideToggle();
}









