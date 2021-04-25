
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <script src="<?php echo URLROOT; ?>/js/jquery.js"></script>
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bootstrap.min.css">


    <title><?php echo SITENAME; ?></title>
</head>
<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-2 col-xl-2 p-0 bg-light user-side-bar-menu">
                <ul class="user-template-ul">    
                    <a href="<?php echo URLROOT . '/users/dashboard'; ?>" class="user-tem-a-links"><li class="user-tem-li-item">Dashboard</li></a>
                    <a href="<?php echo URLROOT . '/users/user_result'; ?>" class="user-tem-a-links"><li class="user-tem-li-item">Results</li></a>
                    <a href="<?php echo URLROOT . '/users/logout'; ?>" class="user-tem-a-links"><li class="user-tem-li-item">Logout</li></a>
                </ul>
            </div>


            <div class="alert alert-success" id="alert-msg">
                <strong id="alert-status"></strong> <span class="alert-text-quiz-add" id="alert-text-title"></span>
            </div>
       



    