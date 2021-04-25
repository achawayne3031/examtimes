
<?php


$output = "";
$alpha = ['A', 'B', 'C', 'D', 'E'];

if(!empty($data['quiz'])){


foreach ($data['quiz'] as $key => $value) {

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
                    <td class='text-center'>No Quiz Found</td>
                </tr>";
}





?>



<?php require APPROOT .'/views/inc/admin-template.php'; ?>

    
<div class="col-lg-10 col-md-10 col-xl-10 offset-xl-2 offset-lg-2 offset-md-2">


    <section class="mt-4">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-lg-6 col-xl-6">
                    <input type="text" id="quiz-name" value="<?php echo $data['current'][0]->quiz_name;?>" hidden>
                    <input type="text" id="quiz-id" value="<?php echo $data['current'][0]->quiz_id;?>" hidden>

                    <input type="text" id="total-quiz" value="<?php echo count($data['quiz']); ?>" hidden>
                    <h5 class="mb-3">Quiz name: <b><?php echo $data['current'][0]->quiz_name; ?></b></h5>

                        <table class="table">
                            <?php echo $output; ?>
                            <tr>
                                <td>
                                    <?php if(!empty($data['quiz'])){ ?>
                                        <button class="btn btn-success" onclick="registerAnsByAdmin()">Submit Ans</button>
                                    <?php } ?>
                                </td>
                            </tr>
                        </table>
                </div>
            </div>
        </div>
    </section>




    <?php //print_r($data['quiz']); ?>





</div>







<?php require APPROOT .'/views/inc/admin-template-footer.php'; ?> 







