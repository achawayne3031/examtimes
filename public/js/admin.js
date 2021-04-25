




///================ Admin Global functions =========///////

var urlroot = $("#urlroot").val();




function getCurrentQuiz(){
    $.get(urlroot + "/admins/show_current_file",
    function(data, status){
        $("#quiz-view-table").html(data);
    });
}



function showAlertmsg(status, msg){
    $('#alert-msg').show();
    $("#alert-status").html(status);
    $("#alert-text-title").html(msg);

    setTimeout(function(){
        $('#alert-msg').fadeOut();
    }, 5000);
}


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


function hideContent(){
    $("#question-info").hide();
    $("#create-subject-con-btn").hide();
    $("#basic-subject-info").show();
    $("#hide-edit-content-btn").hide();

    var subject = $("#subject").val();
    var year = $("#year").val();
    var timer = $("#timer").val();
    var mark = $("#mark").val();
    $("#current-subject").html(subject);
    $("#current-year").html(year);
    $("#current-timer").html(timer);
    $("#current-mark").html(mark);
}




function emptyFields(){
    $("input[name='a']").prop("checked", false);
    $("input[name='b']").prop("checked", false);
    $("input[name='c']").prop("checked", false);
    $("input[name='d']").prop("checked", false);
    $("input[name='e']").prop("checked", false);

    $("#option-a").val("");
    $("#option-b").val("");
    $("#option-c").val("");
    $("#option-d").val("");
    $("#option-e").val("");

    $("#quizQuestion").val("");
}




function emptyNewFields(){
    $("input[name='n-a']").prop("checked", false);
    $("input[name='n-b']").prop("checked", false);
    $("input[name='n-c']").prop("checked", false);
    $("input[name='n-d']").prop("checked", false);
    $("input[name='n-e']").prop("checked", false);

    $("#n-option-a").val("");
    $("#n-option-b").val("");
    $("#n-option-c").val("");
    $("#n-option-d").val("");
    $("#n-option-e").val("");

    $("#newQuestion").val("");
}




function ajaxHttpCall(url, data, idText, idLoader){
    startbtnLoader(idText, idLoader);
    $.ajax({
        url: urlroot + url,
        type: 'POST', 
        timeout: 10000,
        data: data,
        success: function (data, status, xhr) {   
            stopBtnLoader(idText, idLoader);
           if(data == true){
                showAlertmsg('Success', '');
            }else{
                showAlertmsg('Error', '');
            }
         
        },
        error: function (jqXhr, textStatus, errorMessage) {
            showAlertmsg('Error', errorMessage);
            stopBtnLoader(idText, idLoader);
        }
    });
}





function ajaxHttpCallAdd(url, data, idText, idLoader){
    startbtnLoader(idText, idLoader);
    $.ajax({
        url: urlroot + url,
        type: 'POST', 
        timeout: 10000,
        data: data,
        success: function (data, status, xhr) {   
            stopBtnLoader(idText, idLoader);
           if(data == true){
                showAlertmsg('Success', '');
                $("#add-diagram-btn-switch").show();
                $("#create-quiz-btn").hide();
                $("#hide-content-btn").show();
                document.getElementById("subject").setAttribute('disabled', true); 
                document.getElementById("year").setAttribute('disabled', true); 
                document.getElementById("timer").setAttribute('disabled', true); 
                document.getElementById("mark").setAttribute('disabled', true); 
                emptyFields();
                $("#diagram-title").val('');
                $("#diagram-desc").val('');
                $("#diagram-img").val('');
                getCurrentQuiz();
            }else{
                showAlertmsg('Error', '');
            }
         
        },
        error: function (jqXhr, textStatus, errorMessage) {
            showAlertmsg('Error', errorMessage);
            stopBtnLoader(idText, idLoader);
        }
    });

}



function ajaxHttpCallAddDiagram(url, data, idText, idLoader){
    startbtnLoader(idText, idLoader);
    $.ajax({
        url: urlroot + url,
        type: 'POST', 
        timeout: 10000,
        data: data,
        contentType: false,
        processData: false,
        success: function (data, status, xhr) {   
            stopBtnLoader(idText, idLoader);
           if(data == true){
                showAlertmsg('Success', '');
                $("#diagram-title").val('');
                $("#diagram-desc").val('');
                $("#diagram-img").val('');
                getCurrentQuiz();
            }else{
                showAlertmsg('Error', '');
            }
         
        },
        error: function (jqXhr, textStatus, errorMessage) {
            showAlertmsg('Error', errorMessage);
            stopBtnLoader(idText, idLoader);
        }
    });

}



function ajaxHttpCallCreateSubject(url, data, idText, idLoader){
    startbtnLoader(idText, idLoader);
    $.ajax({
        url: urlroot + url,
        type: 'POST', 
        timeout: 10000,
        data: data,
        success: function (data, status, xhr) {   
            stopBtnLoader(idText, idLoader);
           if(data == true){
                showAlertmsg('Success', '');
                $("#add-diagram-btn-switch").show();
                $("#create-quiz-btn").hide();
                $("#hide-content-btn").show();
                document.getElementById("subject").setAttribute('disabled', true); 
                document.getElementById("year").setAttribute('disabled', true); 
                document.getElementById("timer").setAttribute('disabled', true); 
                document.getElementById("mark").setAttribute('disabled', true); 
            }else{
                showAlertmsg('Error', '');
            }
         
        },
        error: function (jqXhr, textStatus, errorMessage) {
            showAlertmsg('Error', errorMessage);
            stopBtnLoader(idText, idLoader);
        }
    });

}



function ajaxHttpCallAddQuestion(url, data, idText, idLoader){
    startbtnLoader(idText, idLoader);
    $.ajax({
        url: urlroot + url,
        type: 'POST', 
        timeout: 10000,
        data: data,
        success: function (data, status, xhr) {   
            stopBtnLoader(idText, idLoader);
           if(data == true){
                showAlertmsg('Success', '');
                emptyFields();
                getCurrentQuiz();
            }else{
                showAlertmsg('Error', '');
            }
         
        },
        error: function (jqXhr, textStatus, errorMessage) {
            showAlertmsg('Error', errorMessage);
            stopBtnLoader(idText, idLoader);
        }
    });

}


function  ajaxHttpCallAddNewQuestion(url, data, idText, idLoader){
    startbtnLoader(idText, idLoader);
    $.ajax({
        url: urlroot + url,
        type: 'POST', 
        timeout: 10000,
        data: data,
        success: function (data, status, xhr) {   
            stopBtnLoader(idText, idLoader);
           if(data == true){
                showAlertmsg('Success', 'Question Added');
                emptyNewFields();
               ///// getCurrentQuiz();
            }else{
                showAlertmsg('Error', '');
            }
         
        },
        error: function (jqXhr, textStatus, errorMessage) {
            showAlertmsg('Error', errorMessage);
            stopBtnLoader(idText, idLoader);
        }
    });

}



function diagramModalPopUp(){
    $("#dark-bg").show();
}

function closeDiagramBody(){
    $("#dark-bg").hide();
    $("#diagram-title").val('');
    $("#diagram-desc").val('');
    $("#diagram-img").val('');

}





//================= Admin Add fuctions ==================///////////



function createSubject(paper){
    var subject = $("#subject").val();
    var year = $("#year").val();
    var timer = $("#timer").val();
    var mark = $("#mark").val();

    if(subject != ""){
        if(year != ""){
            if(timer != ""){
                if(mark != ""){
                    $("#quiz-btn-text").hide();
                    $("#quiz-btn-loader").show();
                    var data =  {
                                subject: subject,
                                year: year,
                                paper: paper,
                                timer: timer,
                                mark: mark
                            }

                    ajaxHttpCallCreateSubject('/admins/create_subject', data, 'quiz-btn-text', 'quiz-btn-loader');

                    }else{
                        $("#mark").focus();
                        showAlertmsg('Error', 'Enter the mark weight');
                    }
                }else{
                    $("#timer").focus();
                    showAlertmsg('Error', 'Enter the timer, in Minutes');
                }

        }else{
            $("#year").focus();
            showAlertmsg('Error', 'Enter the year, only numbers allowed');
        }
    }else{
        $("#subject").focus();
        showAlertmsg('Error', 'Enter the subject');
    }
}







function AddDiagram(paper){
    var title = $("#diagram-title").val();
    var desc = $("#diagram-desc").val();
    var img = $("#diagram-img")[0].files[0];
    var imgVal = $("#diagram-img").val();
    var subject = $("#subject").val();

    if(subject != ""){
        if(title != ""){
            removeMsgAlert('title-msg');
            if(desc != ""){
                removeMsgAlert('desc-msg');
                if(imgVal != ""){
                    startbtnLoader('submit-diagram-text', 'submit-diagram-btn-loader');
                    removeMsgAlert('img-msg');
                    var fb = new FormData();
                    fb.append('title', title);
                    fb.append('desc', desc);
                    fb.append('img', img);
                    fb.append('paper', paper);
                    fb.append('subject', subject);
                    ajaxHttpCallAddDiagram('/admins/add_diagram', fb, 'submit-diagram-text', 'submit-diagram-btn-loader');
               
                }else{
                    alertMsgText('img-msg', 'Select the diagram');
                }
            }else{
                alertMsgText('desc-msg', 'Enter the description');
            }
        }else{
            alertMsgText('title-msg', 'Enter the title');
        }
    }else{
        alertMsgText('subject', 'Enter the title');
        showAlertmsg('Error', 'Enter the subject');
    }
   
}






/////////// Admin Add questions ///////////////////

function submitQuestionByAdmin(paper){
    var question = $("#quizQuestion").val();
    var subject = $("#subject").val();

    if(subject != ""){
        if($("#quizQuestion").val().trim().length > 1){
            var arrayA = [];
            var arrayB = [];
            var arrayC = [];
            var arrayD = [];
            var arrayE = [];
            var allArray = [];
            var countA = 0;
            var countB = 0;
            var countC = 0;
            var countD = 0;
            var countE = 0;

            var optionA = $("input[name='a']:checked").val();
            var optionB = $("input[name='b']:checked").val();
            var optionC = $("input[name='c']:checked").val();
            var optionD = $("input[name='d']:checked").val();
            var optionE = $("input[name='e']:checked").val();

            var ansA = $("#option-a").val();
            var ansB = $("#option-b").val();
            var ansC = $("#option-c").val();
            var ansD = $("#option-d").val();
            var ansE = $("#option-e").val();

            var optionValid = "";

            if(optionA != undefined){
                if(ansA != ""){
                    arrayA.push(optionA);
                    arrayA.push(ansA);
                    countA++;
                }else{
                  //  alert("Enter the option A answer");
                    optionValid = 'A';

                }
            }

            if(optionB != undefined){
                if(ansB != ""){
                    arrayB.push(optionB);
                    arrayB.push(ansB);
                    countB++;
                }else{
                 //   alert("Enter the option B answer");
                    optionValid = 'B';
                
                }
            }

            if(optionC != undefined){
                if(ansC != ""){
                    arrayC.push(optionC);
                    arrayC.push(ansC);
                    countC++;
                }else{
                 //   alert("Enter the option C answer");
                    optionValid = 'C';
                   
                }
            }

            if(optionD != undefined){
                if(ansD != ""){
                    arrayD.push(optionD);
                    arrayD.push(ansD);
                    countD++;
                }else{
                   // alert("Enter the option D answer");
                    optionValid = 'D';
                }
            }


            if(optionE != undefined){
                if(ansE != ""){
                    arrayE.push(optionE);
                    arrayE.push(ansE);
                    countE++;
                }else{
                 //   alert("Enter the option E answer");
                    optionValid = 'E';
                    
                }
            }

            if(countA == 1){
                allArray.push(arrayA[0]);
                allArray.push(arrayA[1]);
            }

            if(countB == 1){
                allArray.push(arrayB[0]);
                allArray.push(arrayB[1]);
            }

            if(countC == 1){
                allArray.push(arrayC[0]);
                allArray.push(arrayC[1]);
            }

            if(countD == 1){
                allArray.push(arrayD[0]);
                allArray.push(arrayD[1]);
            }

            if(countE == 1){
                allArray.push(arrayE[0]);
                allArray.push(arrayE[1]);
            }

            
            if(optionValid == ""){
                if(allArray.length != 0){
                    var data = { 
                                paper: paper,
                                quest: question,
                                options: allArray
                             }

                    ajaxHttpCallAddQuestion('/admins/save_question', data, 'submit-question-text', 'submit-quiz-btn-loader');

            }else{
                showAlertmsg('Error', 'Pick an option');
            }
        }else{
            showAlertmsg('Error', 'Enter the option <b>' + optionValid + '</b> answer');
        }
        }else{
            showAlertmsg('Error', 'Enter your question');
        }
    }else{
        showAlertmsg('Error', 'Enter the subject');
    }
}




///////////============== Admin Update Question =========//////////

function updateQuestionByAdmin(paper){
    var question = $("#question").val();
    var fileId = $("#file_id").val();
    var questionNum = $("#question-num").html();
    var questionId = $("#question-log-id").val();

        if($("#question").val().trim().length > 1){
            var arrayA = [];
            var arrayB = [];
            var arrayC = [];
            var arrayD = [];
            var arrayE = [];
            var allArray = [];
            var countA = 0;
            var countB = 0;
            var countC = 0;
            var countD = 0;
            var countE = 0;

            var optionA = $("input[name='a']:checked").val();
            var optionB = $("input[name='b']:checked").val();
            var optionC = $("input[name='c']:checked").val();
            var optionD = $("input[name='d']:checked").val();
            var optionE = $("input[name='e']:checked").val();

            var ansA = $("#option-a").val();
            var ansB = $("#option-b").val();
            var ansC = $("#option-c").val();
            var ansD = $("#option-d").val();
            var ansE = $("#option-e").val();

            var optionValid = "";
            if(optionA != undefined){
                if(ansA != ""){
                    arrayA.push(optionA);
                    arrayA.push(ansA);
                    countA++;
                }else{
                    optionValid = 'A';

                }
            }

            if(optionB != undefined){
                if(ansB != ""){
                    arrayB.push(optionB);
                    arrayB.push(ansB);
                    countB++;
                }else{
                    optionValid = 'B';
                
                }
            }

            if(optionC != undefined){
                if(ansC != ""){
                    arrayC.push(optionC);
                    arrayC.push(ansC);
                    countC++;
                }else{
                    optionValid = 'C';
                   
                }
            }

            if(optionD != undefined){
                if(ansD != ""){
                    arrayD.push(optionD);
                    arrayD.push(ansD);
                    countD++;
                }else{
                    optionValid = 'D';
                }
            }


            if(optionE != undefined){
                if(ansE != ""){
                    arrayE.push(optionE);
                    arrayE.push(ansE);
                    countE++;
                }else{
                    optionValid = 'E';
                    
                }
            }

            if(countA == 1){
                allArray.push(arrayA[0]);
                allArray.push(arrayA[1]);
            }

            if(countB == 1){
                allArray.push(arrayB[0]);
                allArray.push(arrayB[1]);
            }

            if(countC == 1){
                allArray.push(arrayC[0]);
                allArray.push(arrayC[1]);
            }

            if(countD == 1){
                allArray.push(arrayD[0]);
                allArray.push(arrayD[1]);
            }

            if(countE == 1){
                allArray.push(arrayE[0]);
                allArray.push(arrayE[1]);
            }

            
            if(optionValid == ""){
                if(allArray.length != 0){

               //   startSubmitQusetionLoader();

                $.ajax(urlroot + '/admins/edit_question', {
                    type: 'POST',  // http method
                    data: { 
                        paper: paper,
                        quest: question,
                        options: allArray,
                        num: questionNum,
                        id: fileId

                     },  // data to submit
                        success: function (data, status, xhr) {

                                if(data == true){
                                  //  emptyFields();
                               //     stopSubmitQusetionLoader();
                                    showAlertmsg('Success', 'Question has been Updated');
                                   // getCurrentQuiz();
                                }else{
                                    showAlertmsg('Error', 'Create a quiz');
                                    stopSubmitQusetionLoader();
                                }
                         
                        },
                        error: function (jqXhr, textStatus, errorMessage) {
                                alert('Error' + errorMessage);
                        }
                });

            }else{
                alert("Pick an option");
            }

        }else{
            showAlertmsg('Error', 'Enter the option <b>' + optionValid + '</b> answer');
        }

        }else{
            alert("Enter your question");
        }

}











//////////////======= Admin register Answer ===========//////////////\


function registerAnsByAdmin(paper){
    var subject = $("#subject").val();
    var id = $("#id").val();
    var year = $("#year").val();
    var file_id = $("#file_id").val();

    var alpha = ['A', 'B', 'C', 'D', 'E'];
    var questionAns = [];
    var totalQuiz = $("#total-question").val();
    var validAns = false;
    var validCount = 0;

    for(var i = 1; i <= totalQuiz; i++){
        var selected = $("input[type='radio'][name='"+i+"']:checked").val();
        if(selected == undefined){
            showAlertmsg('Error', 'Question <b>' + i + '</b> answer has not been selected');
        }
        questionAns.push(selected);
    }

   
    for(var j = 0; j < questionAns.length; j++){
        if(questionAns[j] != undefined){
            validCount++
            validAns = true;
        }
    }

    if(questionAns.length == validCount){

        var data = { 
            subject: subject,
            id: id,
            year: year,
            file_id: file_id,
            ans: questionAns,
            paper: paper
           }

        ajaxHttpCall('/admins/admin_register_ans', data, 'admin-submit-ans-text', 'admin-submit-ans-loader');
     
    }
}






///////////////// edit question from edit page/////////////////////////

function submitQuestionByAdminFromEditPage(paper){
    var question = $("#newQuestion").val();
    var subject = $("#subject").val();
    var year = $("#year").val();
    var file_id = $("#file_id").val();

    if(subject != ""){
        if($("#newQuestion").val().trim().length > 1){

            var arrayA = [];
            var arrayB = [];
            var arrayC = [];
            var arrayD = [];
            var arrayE = [];
            var allArray = [];
            var countA = 0;
            var countB = 0;
            var countC = 0;
            var countD = 0;
            var countE = 0;

            var optionA = $("input[name='n-a']:checked").val();
            var optionB = $("input[name='n-b']:checked").val();
            var optionC = $("input[name='n-c']:checked").val();
            var optionD = $("input[name='n-d']:checked").val();
            var optionE = $("input[name='n-e']:checked").val();

            var ansA = $("#n-option-a").val();
            var ansB = $("#n-option-b").val();
            var ansC = $("#n-option-c").val();
            var ansD = $("#n-option-d").val();
            var ansE = $("#n-option-e").val();

            var optionValid = "";


            if(optionA != undefined){
                if(ansA != ""){
                    arrayA.push(optionA);
                    arrayA.push(ansA);
                    countA++;
                }else{
                    optionValid = 'A';

                }
            }

            if(optionB != undefined){
                if(ansB != ""){
                    arrayB.push(optionB);
                    arrayB.push(ansB);
                    countB++;
                }else{
                    optionValid = 'B';
                
                }
            }

            if(optionC != undefined){
                if(ansC != ""){
                    arrayC.push(optionC);
                    arrayC.push(ansC);
                    countC++;
                }else{
                    optionValid = 'C';
                   
                }
            }

            if(optionD != undefined){
                if(ansD != ""){
                    arrayD.push(optionD);
                    arrayD.push(ansD);
                    countD++;
                }else{
                    optionValid = 'D';
                }
            }


            if(optionE != undefined){
                if(ansE != ""){
                    arrayE.push(optionE);
                    arrayE.push(ansE);
                    countE++;
                }else{
                    optionValid = 'E';
                    
                }
            }

            if(countA == 1){
                allArray.push(arrayA[0]);
                allArray.push(arrayA[1]);
            }

            if(countB == 1){
                allArray.push(arrayB[0]);
                allArray.push(arrayB[1]);
            }

            if(countC == 1){
                allArray.push(arrayC[0]);
                allArray.push(arrayC[1]);
            }

            if(countD == 1){
                allArray.push(arrayD[0]);
                allArray.push(arrayD[1]);
            }

            if(countE == 1){
                allArray.push(arrayE[0]);
                allArray.push(arrayE[1]);
            }

            
            if(optionValid == ""){
                if(allArray.length != 0){
                    var data = { 
                                file: file_id,
                                paper: paper,
                                quest: question,
                                options: allArray
                             }

                    ajaxHttpCallAddNewQuestion('/admins/add_question', data, 'submit-edit-question-text', 'submit-edit-question-btn-loader');

            }else{
                showAlertmsg('Error', 'Pick an option');
            }
        }else{
            showAlertmsg('Error', 'Enter the option <b>' + optionValid + '</b> answer');
        }
        }else{
            showAlertmsg('Error', 'Enter your question');
            $("#newQuestion").focus();

        }
    }else{
        showAlertmsg('Error', 'Enter the subject');
    }
}



/////================ Admin Edit Answer=================///////////

function editAnsByAdmin(paper){
    var subject = $("#subject").val();
    var year = $("#year").val();
    var fileId = $("#file-id").val();
    var id = $("#id").val();
   
    var alpha = ['A', 'B', 'C', 'D', 'E'];
    var quizAns = [];
    var totalQuiz = $("#total-question").val();
    var validAns = false;
    var validCount = 0;

    for(var i = 1; i <= totalQuiz; i++){
        var selected = $("input[type='radio'][name='"+i+"']:checked").val();
        if(selected == undefined){
            showAlertmsg('Error', 'Question <b>' + i + '</b> answer has not been selected');
        }
        quizAns.push(selected);
    }

   
    for(var j = 0; j < quizAns.length; j++){
        if(quizAns[j] != undefined){
            validCount++
            validAns = true;
        }
    }

    if(quizAns.length == validCount){       
            var data = { 
                        paper: paper,
                        ans: quizAns,
                        subject: subject,
                        year: year,
                        file_id: fileId,
                        id: id 
                     }

            ajaxHttpCall('/admins/admin_edit_ans', data, 'admin-edit-ans-text', 'admin-edit-ans-loader');
    }
}



function editDiagram(){
    $("#dark-bg").show();
}





////////// Filter page ////////////////

function filterPaper(paper){
    var subject = $("#subject").val();
    var from = $("#from").val();
    var to = $("#to").val();

    if(from == ""){
        from = 0;
    }

    if(to == ""){
        to = 0;
    }

    if(subject != ""){
        window.location = urlroot + '/admins/filters/' + paper + '/' + subject + '/' + from + '/' + to;
    }
}
