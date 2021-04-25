
<?php require APPROOT .'/views/inc/navbar.php'; ?>
<?php require APPROOT .'/views/inc/header.php'; ?>

<div class="container-fluid">
    <div class="row" id="jamb-body-row">
        <div class="col-lg-10 col-xl-10 col-md-10 col-sm-10 offset-sm-1 col-10 offset-1 p-0">

        <section class="mt-5 pt-3 pb-3" id="jamb-section-one">
            <div class="container">
                <div class="d-flex justify-content-center">
                    <div>
                        <?php if($data['status']){ ?>
                            <h6 class="badge badge-danger p-1 float-center">No Question Available</h6>
                        <?php } ?>
                    </div>
                </div>
                
                <input type="text" id="paper" value="jamb" hidden>
                <div class="row">
                    <div class="col-lg-4 col-xl-4 col-md-4 mb-5">
                        <div class="text-center">
                            <h6 class="badge badge-pill badge-info p-1">Select the subject</h6>
                            <select name="subject" id="subject" class="form-control">
                                <option value=""></option>
                                <?php   foreach ($data['jamb'] as $value) { ?>  
                                    <option value="<?php echo strtolower($value); ?>" onclick="getYear()"><?php echo $value; ?></option>    
                                 <?php   } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-xl-4 col-md-4 mb-5">
                        <div class="text-center">
                            <h6 class="badge badge-pill badge-info p-1">Select the Year</h6>
                            <select name="year" id="year" class="form-control" disabled>
                                <option></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-4 col-xl-4 col-md-4 mb-5 pt-4">
                        <div class="text-center">
                            <button class="btn btn-secondary btn-block" id="load-subject-current-btn" onclick="loadSubject()">Load Subject</button>
                        </div>
                    </div>
                   
                </div>
            </div>
        </section>

    
        </div>
    </div>
</div>


<?php require APPROOT .'/views/inc/footer.php'; ?>
