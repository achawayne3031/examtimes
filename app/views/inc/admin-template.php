

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/jquery-ui.css">
    <script src="<?php echo URLROOT; ?>/js/jquery.js"></script>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/font-awesome.min.css">


    <title><?php echo SITENAME; ?></title>
</head>
<body>

                <!-- <div class="col-lg-4 col-md-4 col-xl-4 flash-msg">
                    <?php //flash('deleted'); ?>
                </div>  -->

    <div class="container-fluid">
        <div class="row">
        <input type="text" id="urlroot" value="<?php echo URLROOT; ?>" hidden>
            <div class="col-lg-2 col-md-2 col-xl-2 p-0 bg-light admin-side-bar-menu">
                <ul class="admin-template-ul">    
                    <a href="<?php echo URLROOT . '/admins/dashboard'; ?>" class="admin-tem-a-links"><li class="admin-tem-li-item">Dashboard</li></a>

                    <li class="jamb-admin-tem-li-item" onclick="toggleLink('ul-jamb-section')">Jamb Section <span class="fa fa-angle-right float-right"></span></li>
                        <ul id="ul-jamb-section">    
                            <a href="<?php echo URLROOT . '/admins/add/jamb'; ?>" class="admin-tem-a-links"><li class="ul-paper-links">Add Jamb Question</li></a>
                            <a href="<?php echo URLROOT . '/admins/all/jamb'; ?>" class="admin-tem-a-links"><li class="ul-paper-links">View Jamb Question</li></a>
                            <a href="<?php echo URLROOT . '/admins/ans/jamb'; ?>" class="admin-tem-a-links"><li class="ul-paper-links">Reg Jamb Answer</li></a>
                        </ul>
                   
                    <li class="waec-admin-tem-li-item" onclick="toggleLink('ul-waec-section')">Waec Section <span class="fa fa-angle-right float-right"></span></li>
                        <ul id="ul-waec-section">    
                            <a href="<?php echo URLROOT . '/admins/add/waec'; ?>" class="admin-tem-a-links"><li class="ul-paper-links">Add Waec Question</li></a>
                            <a href="<?php echo URLROOT . '/admins/all/waec'; ?>" class="admin-tem-a-links"><li class="ul-paper-links">View Waec Question</li></a>
                            <a href="<?php echo URLROOT . '/admins/ans/waec'; ?>" class="admin-tem-a-links"><li class="ul-paper-links">Reg Waec Answer</li></a>
                        </ul>


                    <li class="neco-admin-tem-li-item" onclick="toggleLink('ul-neco-section')">Neco Section <span class="fa fa-angle-right float-right"></span></li>
                        <ul id="ul-neco-section">    
                            <a href="<?php echo URLROOT . '/admins/add/neco'; ?>" class="admin-tem-a-links"><li class="ul-paper-links">Add Neco Question</li></a>
                            <a href="<?php echo URLROOT . '/admins/all/neco'; ?>" class="admin-tem-a-links"><li class="ul-paper-links">View Neco Question</li></a>
                            <a href="<?php echo URLROOT . '/admins/ans/neco'; ?>" class="admin-tem-a-links"><li class="ul-paper-links">Reg Neco Answer</li></a>
                        </ul>

<!-- 


                    <a href="<?php echo URLROOT . '/admins/all_quiz'; ?>" class="admin-tem-a-links"><li class="admin-tem-li-item">All Quiz</li></a>
                    <a href="<?php echo URLROOT . '/admins/add_quiz'; ?>" class="admin-tem-a-links"><li class="admin-tem-li-item">Add New Quiz</li></a>
                    <a href="<?php echo URLROOT . '/admins/edit_quiz'; ?>" class="admin-tem-a-links"><li class="admin-tem-li-item">Edit Quiz</li></a>
                    <a href="<?php echo URLROOT . '/admins/delete_quiz'; ?>" class="admin-tem-a-links"><li class="admin-tem-li-item">Delete Quiz</li></a>
                    <a href="<?php echo URLROOT . '/admins/ans_quiz'; ?>" class="admin-tem-a-links"><li class="admin-tem-li-item">Answers to Quiz</li></a>
 -->

                    <a href="<?php echo URLROOT . '/admins/all_results'; ?>" class="admin-tem-a-links"><li class="admin-tem-li-item">Results</li></a>
                    
                    <a href="<?php echo URLROOT . '/admins/reg_users'; ?>" class="admin-tem-a-links"><li class="admin-tem-li-item">Registered Users</li></a>
                    <a href="<?php echo URLROOT . '/admins/logout'; ?>" class="admin-tem-a-links"><li class="admin-tem-li-item">Logout</li></a>
                </ul>
            </div>

                        
               


            <div class="alert alert-success" id="alert-msg">
                <strong id="alert-status"></strong> <span class="alert-text-quiz-add" id="alert-text-title"></span>
            </div>
  

    