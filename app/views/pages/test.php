
<?php

    $output = "";
    $alpha = ['A', 'B', 'C', 'D', 'E'];


if(!empty($data['questions'])){
    foreach ($data['questions'] as $value){

        if($value->diagram){
            $output .= "<tr>
                        <td>
                            <h6 class='p-2 diagram-test-desc'>".$value->title."</h6>
                            "; if(file_exists(DEFAULTROOT.$value->img)){
                                    $output .="<img src='".URLROOT.$value->img."' class='img-fluid img-test-diagram'>";
                                } else {
                                $output .= "<h6>no img found</h6>";
                                }
            
                        $output .= "<h6 class='p-3 diagram-test-desc'>".$value->desc."</h6>
                        </td>
                    </tr>";

        }else{
        $output .= "<tr class='pb-4'>
                        <td id='questions'><span class='pr-2' id='numbering-index'>". $value->id .".</span><b>". $value->question ."</b><br>";   
                        for($i = 0; $i < count($value->options); $i++){
                            $output .= " <ul id='quiz-view-ul'>
                                            <li class='quiz-list'>
                                            <input type='radio' name='".$value->id."' id='".$alpha[$i]."' class='take-quiz-checkbox' value='".$alpha[$i]."'>".$alpha[$i].". ".$value->options[$i]."</li>
                                        </ul>";
                        
                            }  

        $output .= "</td></tr>";
        }
    }

  
}






?>

<?php require APPROOT .'/views/inc/navbar.php'; ?>
<?php require APPROOT .'/views/inc/header.php'; ?>


    <input type="text" id="active" value="<?php echo $data['active']; ?>" hidden>

    <div class="container-fluid">
        <!-- <div class="row">
            <div class="col-lg-2 col-md-2 col-xl-2 col-sm-2 col-3">
                <img src="<?php echo URLROOT . '/public/img/jamb.png'; ?>">
            </div>
        </div> -->

        <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-12">
                <!-- <h5><?php echo $data['update']; ?></h5> -->
                <input type="text" id="paper" value="<?php echo $data['paper']; ?>" hidden>
                <input type="text" id="subject" value="<?php echo $data['details']->subject; ?>" hidden>
                <input type="text" id="year" value="<?php echo $data['details']->year; ?>" hidden>
                <input type="text" id="total-quiz" value="<?php echo count($data['questions']); ?>" hidden>
                <input type="text" id="org-timer" value="<?php echo $data['details']->timer; ?>" hidden>

                <section>
               
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <?php if(!empty($data['details'])){ ?>

                                <h3 class="past-question-name-title"><span class="public-name-title"><?php echo $data['paper']; ?></span> Past Question</h3>
                                <h5 class="past-question-sub">Subject: <b class="public-name-title"><?php echo $data['details']->subject; ?></b></h5>
                                <h6 class="past-question-sub">Year: <?php echo $data['details']->year; ?></h6>
                                <?php if(!empty($data['questions'])){ ?>
                                <h6 class="past-question-sub">Question No: <b><?php echo count($data['questions']); ?></b></h6>
                                <?php }else{ echo "<h6>Question No: 0</h6>"; } ?>

                                <?php } ?>

                                
                                <div class="float-right" id="timer-display">
                                    <div class="pr-2">
                                        <h5 class="past-question-sub">Hours: <span id="hrs"><?php echo $data['details']->timer; ?></span></h5>
                                    </div>
                                    <div class="pr-2">
                                        <h5 class="past-question-sub">Minutes: <span id="min"><?php echo $data['details']->timer; ?></span></h5>
                                    </div>
                                  
                                    <div class="pr-2">
                                        <h5 class="past-question-sub">Seconds: <span id="sec"><?php echo $data['details']->timer; ?></span></h5>
                                    </div> 
                                </div>
                            </div>
                        
                        </div>
                    
                    </div>
                    <hr>
                </section>
                
                <section>
                    <div class="d-flex justify-content-center mb-3">
                        <?php 
                            if(!empty($data['details'])){
                                if(!$data['avail_ans']){ 
                                    if($data['details']->id){
                                        echo '<div>
                                                <span class="alert alert-danger no-ans-alert-msg">You can\'t take this question at the moment</span>
                                            </div>';
                                    }
                                } 
                            }else{
                                echo '<div>
                                        <span class="alert alert-danger no-ans-alert-msg">Question does not exist</span>
                                    </div>';
                            }
                        ?>    
                    </div>

                    <table class="table table-borderless">
                        <?php echo $output; ?>
                        <tr>
                            <td>
                                <?php 
                                    if(!empty($data['details'])){
                                        if($data['avail_ans']){ ?>
                                            <button class="btn btn-success" onclick="processAnsFastForUser()" id="submit-ans-user-btn">
                                                <span>Submit</span>
                                            </button>
                                            <button class="btn btn-primary" onclick="reloadTestEnviro()" id="re-take-question-user-btn">
                                                <span>Re-take Question</span>
                                            </button>
                                        <?php }else{ ?>
                                            <button class="btn btn-success" id="btn-unactive">You can't take this question at the moment</button>
                                        <?php  }
                                    }
                                ?>
                            </td>
                        </tr>
                       
                    </table>
                
                </section>
               
            </div>
        </div>
    </div>
<?php require APPROOT .'/views/inc/footer.php'; ?>


<script>

var timer = new easytimer.Timer();

timer.addEventListener('secondsUpdated', function (e) {
    $("#hrs").html(timer.getTimeValues().hours);
    $("#min").html(timer.getTimeValues().minutes);
    $("#sec").html(timer.getTimeValues().seconds);
    if(timer.getTimeValues().hours == 0){
        if(timer.getTimeValues().minutes == 5){
            $("#timer-display").css({"background-color": "red", "color": "white"});
           
        }
    }
});


timer.addEventListener('targetAchieved', function (e) {
    endCountDown(timer);
});


function startTest(){
    $("#dark-bg2").hide();
    var duration = $("#min").html();
    var duration = duration * 60;
    timer.start({countdown: true, startValues: {seconds: duration}});
}



function endCountDown(){
    processAnsFastForUser();
    timer.stop();
}


var active = $("#active").val();
if(active == true){
    checkBody();
}else{
    $("#hrs").html(00);
    $("#min").html(00);
    $("#sec").html(00);
}

function checkBody(){
    $("#dark-bg2").show();
}



function processAnsFastForUser(){
   timer.stop();
  // $("#dark-bg").show();
    $("#dark-bg3").show();
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
   
   $.ajax('http://localhost/mvc/quiz/pages/quick_process_user_result', {
       type: 'POST',  // http method
       data: { 
           subject: subject,
           year: year,
           paper: paper,
           ans: quizAns
          
        },  // data to submit
           success: function (data, status, xhr) {
                $("#dark-bg3").hide();
                $("#dark-bg").show();
               $("#current-ans").html(data);
               $("#submit-ans-user-btn").hide();
               $("#re-take-question-user-btn").show();
           },
           error: function (jqXhr, textStatus, errorMessage) {
                   alert('Error' + errorMessage);
           }
   });
}




</script>















