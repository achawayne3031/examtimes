
<?php

   $quiz_taken_output = "";
   $sn = 0;

    if(!empty($data['results'])){
        foreach ($data['results'] as $value) {
            $sn++;
            $quiz_taken_output .= "<tr>
                                        <td>".$sn."</td>
                                        <td>".$value->quiz_name."</td>
                                        <td>".$value->scores."</td>
                                        <td>
                                            <a href='re_take_quiz/".$value->quiz_id."' class='btn btn-primary'>Re-take Quiz</a>
                                        </td>
                                    </tr>";
        }
 
    }else{

        $quiz_taken_output .= "<tr>
                                    <td colspan='4'>No Result Found</td>
                                </tr>";
    }


?>


<?php require APPROOT .'/views/inc/user-template.php'; ?>

    
    <div class="col-lg-10 col-md-10 col-xl-10 pt-4">

        <section>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-xl-8">
                        <table class="table">
                            <tr>
                                <th>S/N</th>
                                <th>Quiz</th>
                                <th>Scores</th>
                                <th>Action</th>
                            </tr>
                            <?php echo $quiz_taken_output; ?>
                        </table>     
                    </div>
                </div>
            </div>
        
        </section>

    </div>






<?php require APPROOT .'/views/inc/user-template-footer.php'; ?> 



