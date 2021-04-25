


<?php

$output = "";
$ans_output = "";
$alpha = ['A', 'B', 'C', 'D', 'E'];


if(!empty($data['questions'])){
    foreach ($data['questions'] as $value){
        if($value->diagram){
            $output .= "<tr>
                            <td>
                                <h6 class='p-2 diagram-test-desc'>".$value->title."</h6>
                                "; if(file_exists(DEFAULTROOT.$value->img)){
                                        $output .="<img src='".URLROOT.$value->img."' class='img-fluid admin-show-page-diagram'>";
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
                        
            $output .= "</td>
                            </tr>";
        }
        
    }
}


$ans_count = 0;
$ans_status = 0;
if($data['avail_ans']){
    foreach ($data['ans'] as $value) {
        $ans_count++;
        foreach ($value->ans as $value) {
            $ans_output .= "<tr>
                    <td><span>".$ans_count."</span> ".$value."</td>
                </tr>";
        }

    }
   

    // if($data['file_count'] != $data['ans']){
    //     $ans_output .= "<tr>
    //                         <td>
    //                             <button class='btn btn-success'>Update Answer</button>
    //                         </td>
    //                     </tr>";
    // }

}else {
    $ans_output .= "<tr>
                        <td>
                            <a href='".URLROOT."/admins/reg_ans/".$data['paper']."/".$data['details']->id."' class='btn btn-success'>Register Answer</a>
                        </td>
                    </tr>";
}


?>



<?php require APPROOT .'/views/inc/admin-template.php'; ?>


<div class="col-lg-10 col-md-10 col-xl-10 offset-xl-2 offset-lg-2 offset-md-2">

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-xl-12 col-md-12 col-sm-12 col-12">
                <input type="text" id="paper" value="<?php echo $data['paper']; ?>" hidden>
                <input type="text" id="subject" value="<?php echo $data['details']->subject; ?>" hidden>
                <input type="text" id="year" value="<?php echo $data['details']->year; ?>" hidden>
                <input type="text" id="total-quiz" value="<?php echo count($data['questions']); ?>" hidden>
                <input type="text" id="org-timer" value="<?php echo $data['details']->timer; ?>" hidden>

                <section>
                    <div class="col-lg-12 text-center">
                        <h3 class="past-question-name-title"><span class="public-name-title"><?php echo $data['paper']; ?></span> Past Question</h3>
                        <h5 class="past-question-sub">Subject: <b class="public-name-title"><?php echo $data['details']->subject; ?></b></h5>
                        <h6 class="past-question-sub">Year: <?php echo $data['details']->year; ?></h6>
                        <?php if(!empty($data['questions'])){ ?>
                        <h6 class="past-question-sub">Question No: <b><?php echo count($data['questions']); ?></b></h6>
                        <?php }else{ echo "<h6>Question No: 0</h6>"; } ?>
                    </div>
                    <hr>
                </section>
                
                <section>
                    <div class="row">
                        <div class="col-lg-4 col-xl-4 col-md-4">
                        <h6 class="badge badge-pill badge-info p-1">Question Section</h6>
                            <table class="table table-borderless">
                                <?php echo $output; ?>
                            </table>
                        </div>
                        <div class="col-lg-2 col-xl-2 col-md-2">
                        <h6 class="badge badge-pill badge-info p-1">Answer Section</h6>
                            <table class="table table-borderless">
                                <?php echo $ans_output; ?>
                            </table>
                        </div>
                    </div>
                </section>
            </div>

            </div>
        </div>
</div>
<?php require APPROOT .'/views/inc/footer.php'; ?>