<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/style.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/font-awesome.min.css">

    <title><?php echo SITENAME; ?></title>
</head>
<body>
    <input type="text" id="urlroot" value="<?php echo URLROOT; ?>" hidden>
    <div class="alert alert-success" id="alert-msg">
        <strong id="alert-status"></strong> <span class="alert-text-quiz-add" id="alert-text-title"></span>
    </div>

    <div class="dark-bg" id="dark-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 col-xl-4 offset-xl-4 col-md-4 offset-md-4 col-sm-10 offset-sm-1 col-10 offset-1 p-3 text-center">
                    <section id="test-ans-body" class="process-ans-board p-3">
                        <span class="fa fa-close float-right" id="close-ans-body" onclick="closeAnsBody()"></span>
                        <h5 class="mb-4 scored-text">You Scored <span id="current-ans"></span></h5>
                        <button class="btn btn-primary test-dialog-btn" onclick="closeAnsBody()">End</button>
                    </section> 
                </div>
            </div>
        </div>
    </div> 


    <div class="dark-bg" id="dark-bg3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 col-xl-4 offset-xl-4 col-md-4 offset-md-4 col-sm-10 offset-sm-1 col-10 offset-1 p-3 text-center">
                    <section id="process-loader" class="process-ans-board p-3 text-center">
                        <h6>Processing...............</h6>
                        <img src="<?php echo URLROOT; ?>/public/img/bx_loader.gif" class="img-fluid img-loader">
                    </section>
                </div>
            </div>
        </div>
    </div> 



   

    <div class="dark-bg" id="dark-bg2">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 offset-lg-4 col-xl-4 offset-xl-4 col-md-4 offset-md-4 col-sm-10 offset-sm-1 col-10 offset-1 p-3 text-center">
                    <section id="start-test-section" class="p-3">
                        <button class="btn btn-success test-dialog-btn" onclick="startTest()">Start</button>
                    </section>
                </div>
            </div>
        </div>
    </div> 










    <div class="container">

    