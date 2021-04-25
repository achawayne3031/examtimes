
<?php

    $output = "";

    foreach ($data['all_quiz'] as  $value) {

        if(file_exists(DEFAULTROOT .'/public/logs/'.$value->quiz_id.'.json')){
            $result = file_get_contents(DEFAULTROOT .'/public/logs/'.$value->quiz_id.'.json');
            $result = json_decode($result);
        }

        $num = 0;
        if(!empty($result)){
            $num = count($result);
        }

        $output .= "<div class='col-lg-2 col-md-2 col-xl-2 mt-2 mb-2'>
                        <a href='".URLROOT . '/users/take_quiz/'.$value->quiz_id."' class='btn btn-primary btn-block'>".$value->quiz_name."<sub class='pl-3'>Q: <b>".$num."</b></sub></a>
                    </div>";
       
    }





?>


<?php require APPROOT .'/views/inc/user-template.php'; ?>


    <div class="col-lg-10 col-md-10 col-xl-10 pt-4">
        <section id="dashboard-section-one" class="mb-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-xl-3">
                        <div class="overall-display pt-3 pl-3 pr-3">
                            <h4 class="dashboard-overall-title">Total Quiz Available</h4>
                            <h6 class="dashboard-overall-value float-right mr-4"><span class="badge badge-secondary"><?php echo $data['quiz_count']; ?></span></h6>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-xl-3">
                        <div class="overall-display pt-3 pl-3 pr-3">
                            <h4 class="dashboard-overall-title">Total Quiz Taken</h4>
                            <h6 class="dashboard-overall-value float-right mr-4"><span class="badge badge-secondary"><?php echo count($data['quiz_taken']); ?></span></h6>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-xl-3">
                        <div class="overall-display pt-3 pl-3 pr-3">
                            <h4 class="dashboard-overall-title">Total Quiz Passed</h4>
                            <h6 class="dashboard-overall-value float-right mr-4"><span class="badge badge-success">0</span></h6>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-xl-3">
                        <div class="overall-display pt-3 pl-3 pr-3">
                            <h4 class="dashboard-overall-title">Total Quiz Failed</h4>
                            <h6 class="dashboard-overall-value float-right mr-4"><span class="badge badge-danger">0</span></h6>
                        </div>
                    </div>

                
                </div>
            </div>
        </section> 


        <section id="dashboard-section-two" class="mb-5">
            <div class="conatiner-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-xl-12">
                        <h3>Quiz</h3>
                        <div class="line-div"></div>
                    </div>

                </div>
                <div class="row">

                    <?php echo $output; ?>

                </div>
            </div>
        </section>

    </div>





<?php require APPROOT .'/views/inc/user-template-footer.php'; ?> 
