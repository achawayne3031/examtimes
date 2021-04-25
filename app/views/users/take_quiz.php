<?php

    $output = "";
    $alpha = ['A', 'B', 'C', 'D', 'E'];

    if(!empty($data['current_quiz'])){
        foreach ($data['current_quiz'] as $key => $value) {

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



<?php require APPROOT .'/views/inc/user-template.php'; ?>


        
    <div class="col-lg-10 col-md-10 col-xl-10 pt-4">

        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <input type="text" id="quiz-id" value="<?php echo $data['resultDb']->quiz_id; ?>" hidden>
                        <input type="text" id="quiz-name" value="<?php echo $data['resultDb']->quiz_name; ?>" hidden>
                        <input type="text" id="total-quiz" value="<?php echo count($data['current_quiz']); ?>" hidden>
                        <h5>Quiz name: <b><?php echo $data['resultDb']->quiz_name; ?></b></h5>

                            <table class="table">
                                <?php echo $output; ?>
                                <tr>
                                    <td>
                                        <?php 
                                            if($data['avaliable_ans']){ ?>
                                                <button class="btn btn-success" onclick="submitAnsByUsers()" id="submit-ans-user-btn">Submit</button>
                                           <?php }else{ ?>
                                                <button class="btn btn-success">Preparing......</button>
                                          <?php  }
                                        ?>
                                    </td>
                                </tr>
                            </table>
                    </div>
                </div>
            </div>
        </section>

        


    </div>














<?php require APPROOT .'/views/inc/user-template-footer.php'; ?> 



