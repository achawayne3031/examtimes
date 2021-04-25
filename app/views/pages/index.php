
<?php require APPROOT .'/views/inc/navbar.php'; ?>
<?php require APPROOT .'/views/inc/header.php'; ?>

    <!-- <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-3"><?php echo $data['title']; ?></h1>
            <p class="lead">Simple social network built on the achawayneMCV PHP framework</p>
        </div>
    </div> -->

    <section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-xl-3 col-sm-6 col-6 mb-5">
                    <div class="text-center col-section-body p-3">
                        <img src="<?php echo URLROOT . '/public/img/jamb.png'; ?>" class="img-fluid img-logo">
                        <h6 class="exam-type-title">Jamb Past Questions</h6>
                        <span class="exam-content"></span>
                        <a href="<?php echo URLROOT . '/pages/jamb'; ?>" class="btn btn-secondary go-to-center-btn">Start Now !!</a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-xl-3 col-sm-6 col-6 mb-5">
                    <div class="text-center col-section-body p-3">
                        <img src="<?php echo URLROOT . '/public/img/waec.png'; ?>" class="img-fluid img-logo">
                        <h6 class="exam-type-title">Waec Past Questions</h6>
                        <span class="exam-content"></span>
                        <a href="<?php echo URLROOT . '/pages/waec'; ?>" class="btn btn-secondary go-to-center-btn">Start Now !!</a>
                    </div>
                </div>

                <div class="col-lg-3 col-md-4 col-xl-3 col-sm-6 col-6 mb-5">
                    <div class="text-center col-section-body p-3">
                        <img src="<?php echo URLROOT . '/public/img/neco.jpg'; ?>" class="img-fluid img-logo">
                        <h6 class="exam-type-title">Neco Past Questions</h6>
                        <span class="exam-content"></span>
                        <a href="<?php echo URLROOT . '/pages/neco'; ?>" class="btn btn-secondary go-to-center-btn">Start Now !!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section>
        <h5 class="text-center uni-section-title">General Studies for Universities</h5>
        <hr>
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-2 col-lg-2 col-md-3 col-sm-4 col-6">
                    <div class="text-center section-two-col-body">
                        <img src="<?php echo URLROOT . '/public/img/ansu.jpg'; ?>" class="img-fluid img-gs-logo">
                        <h6 class="exam-type-title">Ansu General Studies Past Questions</h6>
                        <span class="exam-content"></span>
                        <a href="" class="btn btn-secondary go-to-center-btn">Go To School</a>
                    </div>
                </div>



            </div>


        </div>
    </section>

<?php require APPROOT .'/views/inc/footer.php'; ?>






