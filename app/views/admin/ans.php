

<?php

$output = "";
$i = 0;

if(count($data['all_paper']) > 0){
    foreach ($data['all_paper'] as $key => $value) {
        $i++;
    $output .= "<tr>
                    <td>".$i."</td>
                    <td>".$value->subject."</td>
                    <td>".$value->year."</td>";

                    if($value->ans){
                        $output .= "<td>  
                                        <button class='btn btn-primary' disabled>Reg Ans</button>
                                        <a href='".URLROOT."/admins/edit_ans/".$data['paper_name'].'/'.$value->id."' class='btn btn-success'>Edit Answer</a>
                                    </td>";
                    }else{
                        $output .= "  <td>  
                                        <a href='".URLROOT."/admins/reg_ans/".$data['paper_name'].'/'.$value->id."' class='btn btn-primary'>Reg Ans</a>
                                        <button class='btn btn-success' disabled>Edit Ans</button>
                                    </td>";
                    }
    $output .=     "</tr>";
    }


}else{
    $output .= "<tr>
                    <td>No Question Avaialble</td>
                </tr>";
}



?>


<?php require APPROOT .'/views/inc/admin-template.php'; ?>

    
    <div class="col-lg-10 col-md-10 col-xl-10 offset-xl-2 offset-lg-2 offset-md-2">

    <section class="mt-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xl-6">
                        <h5 class="text-center"><b>All Jamb</b></h5>
                        <table class="table">
                            <tr>
                                <td>S/N</td>
                                <td>Subject</td>
                                <td>Year</td>
                                <td>Action</td>
                            </tr>

                            <?php echo $output; ?>

                        </table>
                    
                    </div>
                
                </div>
            </div>
        </section>
    </div>
<?php require APPROOT .'/views/inc/admin-template-footer.php'; ?> 


