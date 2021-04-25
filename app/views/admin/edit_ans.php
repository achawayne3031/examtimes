




<?php


$output = "";
$alpha = ['A', 'B', 'C', 'D', 'E'];
$pre_output = "";

    // print_r($data['current_ans']);
    // echo "<br>";
    // print_r($data['question_file']);
    // echo "<br>";
    // print_r($data['db_question']);


if(!empty($data['current_ans'])){

   if(isset($data['current_ans'])){
        foreach ($data['question_file'] as $value) {
            $output .= "<tr class='pb-4'>
            <td><span class='pr-2'>". $value->id .".</span><b>". $value->question ."</b><br>";   
                for($i = 0; $i < count($value->options); $i++){
                    $output .= " <ul id='quiz-view-ul'>
                                    <li class='quiz-list'><input type='radio' name='".$value->id."' id='".$alpha[$i]."' class='take-quiz-checkbox' value='".$alpha[$i]."'>".$alpha[$i].". ".$value->options[$i]."</li>
                                </ul>";
                
                }  
            
            $output .= "</td>
                            </tr>";
           
        } 

        $num = 0;
        $pre_output .= "<tr>";
            for($i = 0; $i < count($data['current_ans']); $i++){
                $num++;
                $pre_output .= " <ul id='quiz-view-ul'>
                                <li class='quiz-list'>".$num.". ".$data['current_ans'][$i]."</li>
                            </ul>";
            
            }  

        $pre_output .=    "</tr>";
    
   }else{
       
        // if($data['current_ans'][1] == 102){
        //     $output .= "<tr>
        //                     <td colspan='2' class='text-center'>".$data['current_ans'][0]."</td>
        //                 </tr>";
        // }

        // if($data['current_ans'][1] == 103){
        //     $output .= "<tr>
        //                     <td colspan='2' class='text-center'>".$data['current_ans'][0]."</td>
        //                 </tr>";
        // }
   }

}else{

    if($data['op_msg'] != ""){
        $output .= "<tr>
                        <td>".$data['op_msg']."</td>
                        <td><a href='' class='btn btn-light'>Go to register answer</a></td>
                    </tr>";
    }


    // $output .= "<tr>
    //                 <td class='text-center'>No Quiz Found</td>
    //             </tr>";


}





?>





<?php require APPROOT .'/views/inc/admin-template.php'; ?>

    <div class="col-lg-10 col-md-10 col-xl-10 offset-xl-2 offset-lg-2 offset-md-2">
        <section class="mt-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <input type="text" id="subject" value="<?php echo $data['db_question']->subject;?>" hidden>
                        <input type="text" id="file-id" value="<?php echo $data['db_question']->file_id;?>" hidden>
                        <input type="text" id="year" value="<?php echo $data['db_question']->year;?>" hidden>
                        <input type="text" id="id" value="<?php echo $data['db_question']->id;?>" hidden>


                        <input type="text" id="total-question" value="<?php echo count($data['question_file']); ?>" hidden>
                        <h5 class="mb-3">Subject: <b><?php echo $data['db_question']->subject;; ?></b></h5>

                            <table class="table">
                                <?php  echo $output; ?>
                                <tr>
                                    <td>
                                        <?php if(!empty($data['current_ans']) && !empty($data['question_file'])){ ?>
                                            <button class="btn btn-success" onclick="editAnsByAdmin('<?php echo $data['paper_name']; ?>')">
                                                <span id="admin-edit-ans-text">Edit Answer</span>
                                                <div id="admin-edit-ans-loader">
                                                    <span class="spinner-border spinner-border-sm"></span>
                                                </div>
                                            </button>
                                        <?php } ?>
                                    </td>
                                </tr>
                            </table>
                    </div>

                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <h5>Previous Result</h5>
                        <table class="table table-bordered table-condensed">
                                <?php echo $pre_output; ?>
                        </table>
                    </div>
                </div>
            </div>
        </section>


    </div>

<?php require APPROOT .'/views/inc/admin-template-footer.php'; ?> 