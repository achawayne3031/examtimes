

<?php


$output = "";
$alpha = ['A', 'B', 'C', 'D', 'E'];

if(!empty($data['question'])){
    foreach ($data['question'] as $value) {
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

}else{

    $output .= "<tr>
                    <td class='text-center'>No Question Found</td>
                </tr>";
}





?>



<?php require APPROOT .'/views/inc/admin-template.php'; ?>

    
<div class="col-lg-10 col-md-10 col-xl-10 offset-xl-2 offset-lg-2 offset-md-2">
    <section class="mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                    <input type="text" id="subject" value="<?php echo $data['db_paper']->subject;?>" hidden>
                    <input type="text" id="id" value="<?php echo $data['db_paper']->id;?>" hidden>
                    <input type="text" id="file_id" value="<?php echo $data['db_paper']->file_id;?>" hidden>
                    <input type="text" id="year" value="<?php echo $data['db_paper']->year;?>" hidden>


                    <input type="text" id="total-question" value="<?php echo count($data['question']); ?>" hidden>
                    <h5 class="mb-3">Subject: <b><?php echo $data['db_paper']->subject; ?></b></h5>

                        <table class="table">
                            <?php echo $output; ?>
                            <tr>
                                <td>
                                    <?php if(!empty($data['question'])){ ?>
                                        <button class="btn btn-success" onclick="registerAnsByAdmin('<?php echo $data['paper_name']; ?>')">
                                            <span id="admin-submit-ans-text">Submit Answer</span>
                                            <div id="admin-submit-ans-loader">
                                                <span class="spinner-border spinner-border-sm"></span>
                                            </div>
                                        </button>
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                </div>
            </div>
        </div>
    </section>

</div>







<?php require APPROOT .'/views/inc/admin-template-footer.php'; ?> 







