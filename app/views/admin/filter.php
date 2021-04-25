



<?php

$all = $data['filter'];
$output = '';
$i = 0;

if(count($all) > 0){
    foreach ($all as $value) {
        $i++;

        $output .= "<tr>
                        <td>".$i."</td>
                        <td>".$value->subject."</td>
                        <td>".$value->year."</td>
                        <td>".$value->visited."</td>
                        <td>".$value->submitted."</td>
                        <td>".$value->file_id."</td>
                        <td>
                            <a href='".URLROOT ."/admins/show/".$data['paper']."/".$value->id."' class='btn btn-info'>Show</a>
                            <a href='".URLROOT ."/admins/edit/".$data['paper']."/".$value->id."' class='btn btn-secondary'>Edit</a>
                            <a href='".URLROOT ."/admins/delete/".$data['paper']."/".$value->id."' class='btn btn-danger'>Delete</a>
                        </td>
                    </tr>";

       
    }
}else{
    $output .= "<tr>
                    <td colspan='7' class='text-center'>No Question Available</td>
                </tr>";
}



?>





<?php require APPROOT .'/views/inc/admin-template.php'; ?>


<div class="col-lg-10 col-md-10 col-xl-10 offset-xl-2 offset-lg-2 offset-md-2">

<section>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-xl-12 col-md-12 p-0 mt-3">
                    <h6 class="text-center">Filter</h6>
                    <div class="d-flex  justify-content-center">
                        <div class="p-2">
                            <h6 class="badge badge-pill badge-info p-1">Subject</h6>
                            <input type="text" name="" id="subject" class="form-control">
                            <input type="text" id="url" value="<?php echo URLROOT; ?>" hidden>
                        </div>
                        <div class="p-2">
                            <h6 class="badge badge-pill badge-info p-1">From</h6>
                            <input type="number" name="" id="from" class="form-control">
                        </div>
                        <div class="p-2">
                            <h6 class="badge badge-pill badge-info p-1">To</h6>
                            <input type="number" name="" id="to" class="form-control">
                        </div>
                        <div class="pt-4">
                            <button class="btn btn-success" onclick="filterPaper('<?php echo $data['paper']; ?>')">Load</button>
                        </div>
                    </div>
                    <hr>
                </div>
               
                <div class="col-lg-12 col-xl-12 col-md-12 p-0">
                    <table class="table">
                        <tr class="thead-dark">
                            <th>s/n</th>
                            <th>subject</th>
                            <th>year</th>
                            <th>Visited</th>
                            <th>Submitted</th>
                            <th>File</th>
                            <th>Action</th>
                        </tr>
                        <?php echo $output; ?>
                    </table>
                </div>

            </div>
        </div>
    </section>



</div>




<?php require APPROOT .'/views/inc/admin-template-footer.php'; ?> 
