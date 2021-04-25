
<?php require APPROOT .'/views/inc/admin-template.php'; ?>


    <div class="col-lg-10 col-md-10 col-xl-10 offset-xl-2 offset-lg-2 offset-md-2">
        <section id="admin-dashboard-section-one" class="mt-3">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-3 col-xl-3 mb-4">
                        <div class="admin-overall-display pt-2 pl-3 pr-3 pb-2">
                            <h6 class="dashboard-overall-title">Jamb</h6>
                            <h6 class="dashboard-overall-sub-title">Total Jamb Question: <span class="badge badge-secondary float-right"><?php echo $data['jamb_total_question']; ?></span></h6>
                            <h6 class="dashboard-overall-sub-title">Total visited: <span class="badge badge-secondary float-right"><?php echo $data['jamb_total_visited']; ?></span></h6>
                            <h6 class="dashboard-overall-sub-title">Total submitted: <span class="badge badge-secondary float-right"><?php echo $data['jamb_total_submitted']; ?></span></h6>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-xl-3 mb-4">
                        <div class="admin-overall-display pt-2 pl-3 pr-3 pb-2">
                            <h6 class="dashboard-overall-title">Waec</h6>
                            <h6 class="dashboard-overall-sub-title">Total Waec Question: <span class="badge badge-secondary float-right"><?php echo $data['waec_total_question']; ?></span></h6>
                            <h6 class="dashboard-overall-sub-title">Total visited: <span class="badge badge-secondary float-right"><?php echo $data['waec_total_visited']; ?></span></h6>
                            <h6 class="dashboard-overall-sub-title">Total submitted: <span class="badge badge-secondary float-right"><?php echo $data['waec_total_submitted']; ?></span></h6>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-3 col-xl-3 mb-4">
                        <div class="admin-overall-display pt-2 pl-3 pr-3 pb-2">
                            <h6 class="dashboard-overall-title">Neco</h6>
                            <h6 class="dashboard-overall-sub-title">Total Neco Question: <span class="badge badge-secondary float-right"><?php echo $data['neco_total_question']; ?></span></h6>
                            <h6 class="dashboard-overall-sub-title">Total visited: <span class="badge badge-secondary float-right"><?php echo $data['neco_total_visited']; ?></span></h6>
                            <h6 class="dashboard-overall-sub-title">Total submitted: <span class="badge badge-secondary float-right"><?php echo $data['neco_total_submitted']; ?></span></h6>
                        </div>
                    </div>


                    <!-- <div class="col-lg-3 col-md-3 col-xl-3">
                        <div class="admin-overall-display pt-3 pl-3 pr-3">
                            <h4 class="dashboard-overall-title">User</h4>
                            <h6 class="dashboard-overall-value float-right mr-4"><span class="badge badge-secondary"><?php echo $data['user_count']; ?></span></h6>
                        </div>
                    </div> -->

                </div>
            </div>
        </section>

        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-xl-6 col-md-6">
                        <div class="page-visits-div p-3">
                            <h5 id="page-visits-text">Page Visits</h5>
                            <hr class="hr-line">
                            <table class="table table-responsive-xl page-table">
                                <tr class="thead-light">
                                    <th class="page-table-th">Page name</th>
                                    <th class="page-table-th">Url</th>
                                    <th class="page-table-th">Traffic</th>
                                </tr>
                                <?php foreach ($data['page_visit'] as $value) { ?>
                                    <tr>
                                        <td><?php echo $value->name; ?></td>
                                        <td><?php echo $value->url; ?></td>
                                        <td><?php echo $value->traffic; ?></td>
                                    </tr>
                                  <?php  } ?>
                            
                            </table>


                        </div>


                    </div>

                </div>

            </div>


        </section>


    </div>





<?php require APPROOT .'/views/inc/admin-template-footer.php'; ?> 
