




<?php require APPROOT .'/views/inc/admin-template.php'; ?>

<div class="col-lg-10 col-md-10 col-xl-10 offset-xl-2 offset-lg-2 offset-md-2">
    <section class="mt-1">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 col-md-7 col-xl-7 mt-2">
                    <!-- <img src="http://localhost/mvc/quiz/public/img/jamb.png" class="img-fluid add-question-img-logo"> -->
                    <h5 class="text-center">Add New Question</h5>
                    <hr>
                    <div class="flex" id="question-info">
                        <div class="text-center mr-1">
                            <h6 class="badge badge-pill badge-info p-1">Select the subject</h6>
                            <input type="text" name="" id="subject" class="form-control" placeholder="enter the subject">
                        </div>

                        <div class="text-center ml-1">  
                            <h6 class="badge badge-pill badge-info p-1">Select the year</h6> 
                            <input type="number" name="" id="year" class="form-control" placeholder="enter the year">
                        </div>

                        <div class="text-center ml-1">  
                            <h6 class="badge badge-pill badge-info p-1">Set the Minutes</h6> 
                            <input type="number" name="" id="timer" class="form-control" placeholder="enter the timer">
                        </div>
                        <div class="text-center ml-1">  
                            <h6 class="badge badge-pill badge-info p-1">Set the Mark Weight</h6> 
                            <input type="number" name="" id="mark" class="form-control" placeholder="enter the mark">
                        </div>
                    </div>

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

                    <div class="form-group m-0" id="create-subject-con-btn">
                        <table>
                            <tr>
                                <td colspan="2" class="text-center">
                                    <button class="btn btn-success" onclick="createSubject('<?php echo $data['paper']; ?>')" id="create-quiz-btn">
                                        <span id="quiz-btn-text">Create Subject</span>
                                        <div id="quiz-btn-loader">
                                            <span class="spinner-border spinner-border-sm"></span>
                                        </div>
                                    </button>
                                    <button class="btn btn-primary" id="hide-content-btn" onclick="hideContent()">Hide content</button>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <table id="quiz-table" class="table table-borderless mt-1">
                        <tr>
                            <td class="question-td p-0">
                                <h4 class="badge badge-pill badge-info p-1">Question</h4>
                                <textarea name="question-1" id="quizQuestion" class="form-control quiz-question-box" rows="2">

                                </textarea>
                                <br>
                                <table>
                                    <h6 class="badge badge-pill badge-info p-1">Options</h6>
                                    <tr>
                                        <td><input type="checkbox" name="a" id="a" value="a"> A </td>
                                        <td><input type="text" name="option-a" id="option-a" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="b" id="b" value="b"> B</td>
                                        <td><input type="text" name="option-b" id="option-b" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="c" id="c" value="c"> C</td>
                                        <td><input type="text" name="option-c" id="option-c" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="d" id="d" value="d"> D</td>
                                        <td><input type="text" name="option-d" id="option-d" class="form-control"></td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" name="e" id="e" value="e"> E</td>
                                        <td><input type="text" name="option-e" id="option-e" class="form-control"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <button class="btn btn-primary" onclick="submitQuestionByAdmin('<?php echo $data['paper']; ?>')">
                                    <span id="submit-question-text">Submit Question</span>
                                    <div id="submit-quiz-btn-loader">
                                        <span class="spinner-border spinner-border-sm"></span>
                                    </div>
                                </button>
                                <button class="btn btn-info" id="add-diagram-btn-switch" onclick="diagramModalPopUp()">Add Diagram</button>
                            </td>
                        </tr>
                    </table>
                </div>


                <div class="col-lg-5 col-xl-5 col-md-5 pl-5 pt-4">
                    <h6 class="text-center">Added Questions</h6>
                    <hr>
                    <section id="quiz-view-table" class="">


                    </section>
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
                            <input type="text" name="title" id="diagram-title" class="form-control" placeholder="enter the title">
                            <span id="title-msg" class="alert-msg-admin-text"></span>
                        </div>
                        <div class="form-group">
                            <label>diagram description</label>
                            <input type="text" name="description" id="diagram-desc" class="form-control" placeholder="enter the description">
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




