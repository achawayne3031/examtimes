
<?php


$preview_output = "";
$preview_alpha = ['A', 'B', 'C', 'D', 'E'];
$preview_output .= "<table>";
foreach ($data['preview'] as $value) {
  if($value->diagram){
    $preview_output .= "<tr>
      <td>
          <h6 class='text-center diagram-test-desc'>".$value->title."</h6>
            "; if(file_exists(DEFAULTROOT.$value->img)){
                  $preview_output .="<img src='".URLROOT.$value->img."' class='img-fluid admin-diagram-view'>";
               } else {
                $preview_output .= "<h6 class='diagram-test-desc p-2'>no img found</h6>";
               }

        $preview_output .= "<h6 class='p-2 diagram-test-desc'>".$value->desc."</h6>
      </td>
    </tr>";

  }else {
    $preview_output .= "<tr><td class='quiz-text-question'><span class='pr-2'>".$value->id.".</span>".$value->question."</td></tr>"; 
      for($i = 0; $i < count($value->options); $i++){
        $preview_output .= "<tr class='mb-3'><td id='quiz-view-ul' class='ml-1'>";
        $preview_output .= "<span class='pr-2'>".$preview_alpha[$i].". </span>".$value->options[$i]."</td>";
        $preview_output .= "</tr>";
      }  
  }
 
}

  $preview_output .= "</table>";




?>


<?php require APPROOT .'/views/inc/admin-template.php'; ?>

<div class="col-lg-10 col-md-10 col-xl-10 offset-xl-2 offset-lg-2 offset-md-2">
    <section class="mt-2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-xl-6">
                    <h5 class="text-center">Edit Question</h5>
                    <input type="text" id="file_id" value="<?php echo $data['db_paper']->file_id; ?>" hidden>
                    <hr>

                    <div class="flex" id="question-info">
                        <div class="text-center mr-1">
                            <h6 class="badge badge-pill badge-info p-1">Subject</h6>
                            <input type="text" name="" id="subject" class="form-control" value="<?php echo $data['db_paper']->subject; ?>" disabled>
                        </div>

                        <div class="text-center ml-1">  
                            <h6 class="badge badge-pill badge-info p-1">Year</h6> 
                            <input type="number" name="" id="year" class="form-control" value="<?php echo $data['db_paper']->year; ?>" disabled>
                        </div>
                        <div class="text-center ml-1">  
                            <h6 class="badge badge-pill badge-info p-1">The Minutes</h6> 
                            <input type="number" name="" id="timer" class="form-control" value="<?php echo $data['db_paper']->timer; ?>" disabled>
                        </div>
                        <div class="text-center ml-1">  
                            <h6 class="badge badge-pill badge-info p-1">The Mark Weight</h6> 
                            <input type="number" name="" id="mark" class="form-control" value="<?php echo $data['db_paper']->mark; ?>" disabled>
                        </div>
                    </div>

                    <button class="btn btn-primary" id="hide-edit-content-btn" onclick="hideContent()">Hide content</button>

                    <div class="flex" id="basic-subject-info">
                        <div class="box-inline">
                            <h6>Subject: <b id="current-subject"></b></h6>
                        </div>
                        <div class="box-inline">
                            <h6>Year: <b id="current-year"></b></h6>
                        </div>
                        <div class="box-inline">
                            <h6>Timer: <b id="current-timer"></b></h6>
                        </div>
                        <div class="box-inline">
                            <h6>Mark: <b id="current-mark"></b></h6>
                        </div>
                    </div>

                    <table id="quiz-table" class="table table-borderless mt-4">
                        <?php 
                            $output = '';
                        if(!empty($data['current_paper'])){
                            if($data['current_paper']->diagram){ 
                                    $output .= "<tr>
                                                    <td>
                                                        <h6 class='p-2 diagram-test-desc'>".$data['current_paper']->title."</h6>
                                                        "; if(file_exists(DEFAULTROOT.$data['current_paper']->img)){
                                                                $output .="<img src='".URLROOT.$data['current_paper']->img."' class='img-fluid img-test-diagram'>";
                                                            } else {
                                                            $output .= "<h6>no img found</h6>";
                                                            }
                                        
                                                    $output .= "<h6 class='p-3 diagram-test-desc'>".$data['current_paper']->desc."</h6>
                                                    </td>
                                                </tr>";

                                    }else {

                                        ?>
                                  
                        <tr>
                            <td class="question-td p-0">
                                <h6 class="badge badge-pill badge-info p-1"><b>Question <span id="question-num"><?php echo $data['current_paper']->id; ?></span></b></h6>
                                <textarea name="question-1" id="question" class="quiz-question-box form-control">
                                    <?php echo $data['current_paper']->question; ?>
                                </textarea>
                                <br>
                                <table>
                                    <h6>Options</h6>
                                    <?php
                                        $alpha = ['A', 'B', 'C', 'D', 'E'];
                                        $options = $data['current_paper']->options;
                                       

                                        if(count($options) > 0){
                                            for ($i=0; $i < count($options); $i++) { 
                                                $output .= '<tr>
                                                                <td><input type="checkbox" name="'.strtolower($alpha[$i]).'" id="'.strtolower($alpha[$i]).'" value="'.strtolower($alpha[$i]).'" checked> '.$alpha[$i].'</td>
                                                                <td><input type="text" name="option-'.strtolower($alpha[$i]).'" id="option-'.strtolower($alpha[$i]).'" class="form-control" value="'.$options[$i].'"></td>
                                                            </tr>';

                                            }

                                            for ($i=count($options); $i < count($alpha); $i++) { 
                                            $output .= '<tr>
                                                            <td><input type="checkbox" name="'.strtolower($alpha[$i]).'" id="'.strtolower($alpha[$i]).'" value="'.strtolower($alpha[$i]).'"> '.$alpha[$i].'</td>
                                                            <td><input type="text" name="option-'.strtolower($alpha[$i]).'" id="option-'.strtolower($alpha[$i]).'" class="form-control"></td>
                                                        </tr>';
                                            }

                                        }

                                        
                                        
                                    }



                                        echo $output;

                                    ?>

                                    

                                </table>  
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <?php if($data['current_paper']->diagram){ ?>
                                    <button class="btn btn-secondary" onclick="editDiagram()">Edit Diagram</button>
                                <?php }else{ ?>
                                    <button class="btn btn-primary" onclick="updateQuestionByAdmin('<?php echo $data['paper_name']; ?>')">
                                        <span id="submit-question-text">Submit Question</span>
                                        <div id="submit-quiz-btn-loader">
                                            <span class="spinner-border spinner-border-sm"></span>
                                        </div>
                                    </button>
                               <?php } ?>
                            
                                <?php
                                    $current_question_id = $data['current_paper']->id;
                                    $previous_question = $data['current_paper']->id - 2;

                                    if($current_question_id != $data['total_question']){
                                    echo '<a href="'.URLROOT .'/admins/edit_on/'.$data['paper_name'].'/'.$data['db_paper']->id .'/'.$current_question_id .'" class="btn btn-success">Next Question</a>';
                                    }

                                    if($current_question_id > 1){
                                        echo '<a href="'.URLROOT .'/admins/edit_on/'.$data['paper_name'].'/'.$data['db_paper']->id .'/'.$previous_question .'" class="btn btn-secondary">Previous Question</a>';
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

                <div class="col-lg-1 col-xl-1 col-md-1"></div>
                <div class="col-lg-5 col-xl-5 col-md-5">
                    <h6>Current Question</h6>
                    <hr class="mt-0">            
                    <section id="quiz-view-table">
                       
                        <?php echo $preview_output; ?>
                    </section>

                     <!------
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
                                <button class="btn btn-primary" onclick="submitQuestionByAdminFromEditPage('<?php echo $data['paper_name']; ?>')">
                                    <span id="submit-edit-question-text">Add Question</span>
                                    <div id="submit-edit-question-btn-loader">
                                        <span class="spinner-border spinner-border-sm"></span>
                                    </div>
                                </button>
                            </td>
                        </tr>
                    </table>
                    </section>
                     ----->
                </div>
               

            </div>
        </div>
    </section>
</div>





<div class="dark-bg" id="dark-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 col-xl-4 offset-xl-4 col-md-4 offset-md-4 col-sm-10 offset-sm-1 col-10 offset-1 p-3 text-center">
                    <section id="test-ans-body" class="process-ans-board p-3">
                        <span class="fa fa-close float-right" id="close-ans-body" onclick="closeDiagramBody()"></span>
                        <div class="form-group">
                            <label>diagram title</label>
                            <input type="text" name="title" id="diagram-title" class="form-control" value="<?php echo $data['current_paper']->title; ?>">
                            <span id="title-msg" class="alert-msg-admin-text"></span>
                        </div>
                        <div class="form-group">
                            <label>diagram description</label>
                            <input type="text" name="description" id="diagram-desc" class="form-control" value="<?php echo $data['current_paper']->desc; ?>">
                            <span id="desc-msg" class="alert-msg-admin-text"></span>
                        </div>
                        <div class="form-group">
                            <label>Diagram</label>
                            <input type="file" name="diagram" id="diagram-img" class="form-control">
                            <span id="img-msg" class="alert-msg-admin-text"></span>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary test-dialog-btn" onclick="AddDiagram('<?php echo $data['paper']; ?>')">
                                <span id="submit-diagram-text">Add Diagram</span>
                                <div id="submit-diagram-btn-loader">
                                    <span class="spinner-border spinner-border-sm"></span>
                                </div>
                            </button>
                        </div>
                    </section> 
                </div>
            </div>
        </div>
    </div> 





<?php require APPROOT .'/views/inc/admin-template-footer.php'; ?> 





