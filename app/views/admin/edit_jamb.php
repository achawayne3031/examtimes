



<?php require APPROOT .'/views/inc/admin-template.php'; ?>

    <div class="col-lg-10 col-md-10 col-xl-10 offset-xl-2 offset-lg-2 offset-md-2">

        <section class="mt-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <h5 class="text-center">Edit Jamb Question</h5>
                        <input type="text" id="file_id" value="<?php echo $data['db_jamb']->file_id; ?>" hidden>
                        <hr>
    
                        <div class="d-flex">
                            <div class="text-center mr-1">
                                <h6 class="badge badge-pill badge-info p-1">Subject</h6>
                                <input type="text" name="" id="subject" class="form-control" value="<?php echo $data['db_jamb']->subject; ?>" disabled>
                            </div>

                            <div class="text-center ml-1">  
                                <h6 class="badge badge-pill badge-info p-1">Year</h6> 
                                <input type="number" name="" id="year" class="form-control" value="<?php echo $data['db_jamb']->year; ?>" disabled>
                            </div>
                        </div>

                        <!-- <div class="form-group m-0">
                            <table>
                                <tr>
                                    <td><label>Subject</label></td>
                                    <td><input type="text" id="quiz-name" name="quiz-name" class="form-control" disabled value="<?php echo $data['db_quiz'][0]->quiz_name; ?>"></td>
                                    <td>                                   
                                        <button class="btn btn-success" onclick="createQuiz()" id="create-quiz-btn">
                                            <span id="quiz-btn-text">Create Quiz</span>
                                            <div id="quiz-btn-loader">
                                                <span class="spinner-border spinner-border-sm"></span>
                                            </div>
                                        </button> 
                                    </td>
                                </tr>
                            </table>  
                        </div> -->

                        

                        <table id="quiz-table" class="table table-borderless mt-4">
                            <?php if(!empty($data['jamb'])){ ?>
                            <tr>
                                <td class="question-td p-0">
                                    <input type="text" id="question-log-id" value="<?php echo $data['db_quiz'][0]->quiz_id; ?>" hidden>
                                    <h6 class="badge badge-pill badge-info p-1"><b>Question <span id="question-num"><?php echo $data['jamb']->id; ?></span></b></h6>
                                    <textarea name="question-1" id="question" class="quiz-question-box form-control">
                                        <?php echo $data['jamb']->question; ?>
                                    </textarea>
                                    <br>
                                    <table>
                                        <h6>Options</h6>
                                        <?php
                                            $alpha = ['A', 'B', 'C', 'D', 'E'];
                                            $options = $data['jamb']->options;

                                            if(count($options) > 0){
                                                for ($i=0; $i < count($options); $i++) { 
                                                    echo '<tr>
                                                            <td><input type="checkbox" name="'.strtolower($alpha[$i]).'" id="'.strtolower($alpha[$i]).'" value="'.strtolower($alpha[$i]).'" checked> '.$alpha[$i].'</td>
                                                            <td><input type="text" name="option-'.strtolower($alpha[$i]).'" id="option-'.strtolower($alpha[$i]).'" class="form-control" value="'.$options[$i].'"></td>
                                                        </tr>';

                                                }

                                                for ($i=count($options); $i < count($alpha); $i++) { 
                                                echo '
                                                    <tr>
                                                        <td><input type="checkbox" name="'.strtolower($alpha[$i]).'" id="'.strtolower($alpha[$i]).'" value="'.strtolower($alpha[$i]).'"> '.$alpha[$i].'</td>
                                                        <td><input type="text" name="option-'.strtolower($alpha[$i]).'" id="option-'.strtolower($alpha[$i]).'" class="form-control"></td>
                                                    </tr>';
                                                }
                                            
                                            }

                                        ?>

                                    </table>  
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <button class="btn btn-primary" onclick="updateQuestionByAdmin('jamb')">
                                        <span id="submit-question-text">Submit Question</span>
                                        <div id="submit-quiz-btn-loader">
                                            <span class="spinner-border spinner-border-sm"></span>
                                        </div>
                                    </button>
                                
                                    <?php
                                        $current_question_id = $data['jamb']->id;
                                        $previous_question = $data['jamb']->id - 2;

                                        if($current_question_id != $data['total_question']){
                                        echo '<a href="'.URLROOT .'/admins/edit_jamb_on/'.$data['db_jamb']->id .'/'.$current_question_id .'" class="btn btn-success">Next Question</a>';
                                        }

                                        if($current_question_id > 1){
                                            echo '<a href="'.URLROOT .'/admins/edit_jamb_on/'.$data['db_jamb']->id .'/'.$previous_question .'" class="btn btn-secondary">Previous Question</a>';
                                        }


                                    ?>
                                </td>
                            </tr>
                            <?php }else{ ?>

                                <tr>
                                    <td class="text-center">No Question Avaiable</td>
                                </tr>
                          <?php  } ?>
                        </table>
                      
                    </div>


                    <div class="col-lg-6 col-xl-6 col-md-6">
                        <section id="quiz-view-table">
                        <h4>Add Another Question</h4>
                        <table id="quiz-table" class="table table-borderless">
                            <tr>
                                <td class="question-td p-0">
                                    <h6>Question</h6>
                                    <textarea name="question-1" id="newQuestion" class="form-control quiz-question-box" rows="2">

                                    </textarea>
                                    <br>
                                    <table>
                                        <h6>Options</h6>
                                        <tr>
                                            <td><input type="checkbox" name="n-a" id="n-a" value="a"> A </td>
                                            <td><input type="text" name="option-a" id="n-option-a" class="form-control"></td>
                                        </tr>
                                        <tr>
                                            <td><input type="checkbox" name="n-b" id="n-b" value="b"> B</td>
                                            <td><input type="text" name="option-b" id="n-option-b" class="form-control"></td>
                                        </tr>

                                        <tr>
                                            <td><input type="checkbox" name="n-c" id="n-c" value="c"> C</td>
                                            <td><input type="text" name="option-c" id="n-option-c" class="form-control"></td>
                                        </tr>

                                        <tr>
                                            <td><input type="checkbox" name="n-d" id="n-d" value="d"> D</td>
                                            <td><input type="text" name="option-d" id="n-option-d" class="form-control"></td>
                                        </tr>

                                        <tr>
                                            <td><input type="checkbox" name="n-e" id="n-e" value="e"> E</td>
                                            <td><input type="text" name="option-e" id="n-option-e" class="form-control"></td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <button class="btn btn-primary" onclick="submitQuestionByAdminFromEditPage('jamb')">
                                        <span id="submit-question-text">Add Question</span>
                                        <!-- <div id="submit-quiz-btn-loader">
                                            <span class="spinner-border spinner-border-sm"></span>
                                        </div> -->
                                    </button>
                                    <!-- <button onclick="getCurrentQuiz()">Again</button> -->
                                </td>
                            </tr>
                        </table>




                        </section>



                    </div>

                </div>
            </div>
        </section>


    </div>



<?php require APPROOT .'/views/inc/admin-template-footer.php'; ?> 





