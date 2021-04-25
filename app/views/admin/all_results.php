


<?php

$output = "";
$sn = 0;

 if(!empty($data['all_results'])){
     foreach ($data['all_results'] as $value) {
         $sn++;
         $output .= "<tr>
                                     <td>".$sn."</td>
                                     <td>".$value->quiz_name."</td>
                                     <td>".$value->scores."</td>
                                     <td>
                                         <a href='delete_result/".$value->id."' class='btn btn-primary'>Delete Result</a>
                                     </td>
                                 </tr>";
     }

 }else{

     $output .= "<tr>
                                 <td colspan='4'>No Result Found</td>
                             </tr>";
 }


?>





<?php require APPROOT .'/views/inc/admin-template.php'; ?>


    <div class="col-lg-10 col-md-10 col-xl-10 offset-xl-2 offset-lg-2 offset-md-2">

            <section>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-xl-8">
                            <table class="table">
                                <tr class="thead-dark">
                                    <th>S/N</th>
                                    <th>Quiz</th>
                                    <th>Scores</th>
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