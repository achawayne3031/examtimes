<?php

class Admins extends Controller{

    //private $adminModel;

    public $msg;

    public function __construct(){
        $this->adminModel = $this->model('Admin');
    }

    public function auto_register_admin(){
          $password = password_hash('123456789', PASSWORD_DEFAULT);
          $conn = mysqli_connect("localhost", "root", "", "mvcquiz");
          $query = "INSERT INTO admin (email, password) VALUES('achawayne@gmail.com', '$password')";
          mysqli_query($conn, $query);
    }



    public function index(){
        ///// check for POST
        if($_SERVER['REQUEST_METHOD'] == "POST"){
          //// process form
          
          //////// Sanitize the POST
          $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

          ///// init data
          $data = [
              'email' => $this->test_input($_POST['email']),
              'password' => $this->test_input($_POST['password']),
              'email_err' => '',
              'password_err' => '',
          ];

           //// Validate Email
           if(empty($data['email'])){
            $data['email_err'] = 'Please enter email';
        }

        /////// Validate Password
        if(empty($data['password'])){
            $data['password_err'] = 'Please enter password';
        }elseif(strlen($data['password']) < 6){
            $data['password_err'] = 'Password must be at least 6 characters';
        }


        
            ///////// Make sure errors are empty
            if(empty($data['email_err']) && empty($data['password_err'])){
              ////// Validated
              $check_reg_email = $this->adminModel->check_reg_email($data['email']);

              if($check_reg_email){
                  $loggedInAdmin = $this->adminModel->login($data['email'], $data['password']);
                  if($loggedInAdmin){
                      $this->createAdminSession($loggedInAdmin);
                  }else{
                      $data['password_err'] = 'password incorrect';
                      $this->view('admin/login', $data);
                  }
              }else{
                $data['email_err'] = 'Email not registered';
                
                  //// Load views with error
                  $this->view('admin/login', $data);
              }

          }else{
              //// Load views with error
              $this->view('admin/login', $data);
          }


        }else{

          /////// Load Admin Loing Form
            $data = [
              'email' => '',
              'password' => '',
              'email_err' => '',
              'password_err' => ''
            
            ];

          $this->view('admin/login', $data);

        }

    }


    public function dashboard(){
      $this->check_if_logged_in();

      ////////// Page Visits /////////////
      $page_visits = $this->adminModel->page_visit();

      ///////// All users Count //////////////
      $reg_users_num = $this->adminModel->get_all_users_nums();
      $registered = count($reg_users_num);

      //////// Jamb /////////////
      $all_jamb = $this->adminModel->show_all('jamb');
      $jamb_total_question = count($all_jamb);
      $jamb_total_submitted = 0;
      $jamb_total_visited = 0;
      foreach ($all_jamb as $value) {
        $jamb_total_submitted += $value->submitted;
        $jamb_total_visited += $value->visited;
      }


      /////// Waec ///////////
      $all_waec = $this->adminModel->show_all('waec');
      $waec_total_question = count($all_waec);
      $waec_total_submitted = 0;
      $waec_total_visited = 0;
      foreach ($all_waec as $value) {
        $waec_total_submitted += $value->submitted;
        $waec_total_visited += $value->visited;
      }


       /////// Neco ///////////
       $all_neco = $this->adminModel->show_all('neco');
       $neco_total_question = count($all_neco);
       $neco_total_submitted = 0;
       $neco_total_visited = 0;
       foreach ($all_neco as $value) {
         $neco_total_submitted += $value->submitted;
         $neco_total_visited += $value->visited;
       }

      $data = [
        'jamb_total_question' => $jamb_total_question,
        'jamb_total_visited' => $jamb_total_visited,
        'jamb_total_submitted' => $jamb_total_submitted,
        'waec_total_question' => $waec_total_question,
        'waec_total_visited' => $waec_total_visited,
        'waec_total_submitted' => $waec_total_submitted,
        'neco_total_question' => $neco_total_question,
        'neco_total_visited' => $neco_total_visited,
        'neco_total_submitted' => $neco_total_submitted,
        
        'user_count' => $registered,
        'page_visit' => $page_visits
      ];

      $this->view('admin/dashboard', $data);
    }

    public function check_if_logged_in(){
        if(!isset($_SESSION['admin_email'])){
          redirect('admins/login');
        }
    }

    public function all_results(){
        $this->check_if_logged_in();
        $all = $this->adminModel->get_all_results();

        $data = [
          'all_results' => $all
        ];

        $this->view('admin/all_results', $data);
    }




    
    public function createAdminSession($admin){
      session_start();
      $_SESSION['admin_id'] = $admin->id;
      $_SESSION['admin_email'] = $admin->email;
      redirect('admins/dashboard');
    }


  public function logout(){
    session_start();
    unset($_SESSION['admin_id']);
    unset($_SESSION['admin_email']);
  
    session_destroy();
    redirect('admins/login');
  }



  public function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
    return $data;
  }


public function create_subject(){
  $this->check_if_logged_in();

  $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
  $data = [];
  $subject = $this->test_input($_POST['subject']);
  $year = $this->test_input($_POST['year']);
  $paper = $this->test_input($_POST['paper']);
  $timer = $this->test_input($_POST['timer']);
  $mark = $this->test_input($_POST['mark']);

    $result = $this->adminModel->find_subject($paper, $subject, $year);
    if($result == 0){
        $data_result = $this->adminModel->add_subject($paper, $subject, $year, $timer, $mark);
        if($data_result['success']){
          create_question_file($paper, $data_result['file_id']);
          $_SESSION['file_id'] = $data_result['file_id'];
          $_SESSION['current_file'] = DEFAULTROOT .'/public/logs/'.$paper .'/'.$data_result['file_id'].'.json';
          echo true;
        }
    }else{
      echo false;
    }
}


public function add_diagram(){
      $this->check_if_logged_in();
     //////// Sanitize the POST
     $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

     if($_POST['subject']){
       $subject = $_POST['subject'];
       $paper = $_POST['paper'];
       $title = $_POST['title'];
       $desc = $_POST['desc'];

      create_directory($paper.'_diagrams');

      $ex = explode('.', $_FILES["img"]["name"]);
      $valid_extension = array('jpg', 'jpeg', 'png');

      if(in_array(strtolower(end($ex)), $valid_extension)){
        $saveImg = time() . '.' . end($ex);
        move_uploaded_file($_FILES["img"]["tmp_name"], DEFAULTROOT.'/public/logs/'.$paper.'_diagrams/' . $saveImg);
      
        $img = '/public/logs/'.$paper.'_diagrams/'.$saveImg;

        if(isset($_SESSION['file_id'])){
          if(check_file_exist($paper, $_SESSION['file_id'])){
            $path_file = file_path($paper, $_SESSION['file_id']);
            $array_data = open_file($paper, $_SESSION['file_id']);
            $id = 1;
  
            $insert = array(
              'diagram' => true,
              'id' => $id,
              'title' => $title,
              'desc' => $desc,
              'img' => $img
            );
  
            if(!empty($array_data)){
                foreach($array_data as $data){
                    $id = $data->id;
                }

                $id++;
                
                $insert['id'] = $id;
                array_push($array_data, $insert);
                $store_data = json_encode($array_data);
            }else{
              $array_data[] = $insert;
              $store_data = json_encode($array_data);
            }
  
            if(file_put_contents($path_file, $store_data)){
                echo true;  
            }
            
          }else{
            echo '404';
          }  
        }else{
          $alert_back[] = "Enter the question";
          echo $alert_back;
        }
      
      }else{
        $alert_back[] = "File type not supported";
        echo $alert_back;
      }

    }

}


public function save_question(){
    $this->check_if_logged_in();

    $alert_back = [];

    if(isset($_POST['quest'])){
      $paper = $this->test_input($_POST['paper']);
      $question = $this->test_input($_POST['quest']);
      $options = $_POST['options'];

      $arr_options = array();

      for($i = 0; $i < count($options); $i++){
          array_push($arr_options, $options[$i + 1]);
          $i++;
      }

      if(isset($_SESSION['file_id'])){
        if(check_file_exist($paper, $_SESSION['file_id'])){
          $path_file = file_path($paper, $_SESSION['file_id']);
          $array_data = open_file($paper, $_SESSION['file_id']);
          $id = 1;

          $insert = array(
            'diagram' => false,
            'id' => $id,
            'question' => $question,
            'options' => $arr_options
          );

          if(!empty($array_data)){
              foreach($array_data as $data){
                  $id = $data->id;
              }
              $id++;
              $insert['id'] = $id;
              array_push($array_data, $insert);
              $store_data = json_encode($array_data);
          }else{
            $array_data[] = $insert;
            $store_data = json_encode($array_data);
          }

          if(file_put_contents($path_file, $store_data)){
              echo true;  
          }
          
        }else{
          echo '404';
        }  
      }else{
        $alert_back[] = "Enter the question";
        echo $alert_back;
      }

  }else {
      $alert_back[] = "Create a Subject";
      echo $alert_back;
  }

}


public function show_current_file(){
  if(isset($_SESSION['current_file'])){
    $data = file_get_contents($_SESSION['current_file']);
    $json = json_decode($data);
    $output = "";
    $alpha = ['A', 'B', 'C', 'D', 'E'];
    $output .= "<table>";
    foreach ($json as $value) {
      if($value->diagram){
        $output .= "<tr>
          <td>
              <h6 class='text-center diagram-test-desc'>".$value->title."</h6>
                "; if(file_exists(DEFAULTROOT.$value->img)){
                      $output .="<img src='".URLROOT.$value->img."' class='img-fluid admin-diagram-view'>";
                   } else {
                    $output .= "<h6 class='diagram-test-desc p-2'>no img found</h6>";
                   }

            $output .= "<h6 class='p-2 diagram-test-desc'>".$value->desc."</h6>
          </td>
        </tr>";

      }else {
        $output .= "<tr><td class='quiz-text-question'><span class='pr-2'>".$value->id.".</span>".$value->question."</td></tr>"; 
          for($i = 0; $i < count($value->options); $i++){
            $output .= "<tr class='mb-3'><td id='quiz-view-ul' class='ml-1'>";
            $output .= "<span class='pr-2'>".$alpha[$i].". </span>".$value->options[$i]."</td>";
            $output .= "</tr>";
          }  
      }
     
    }

      $output .= "</table>";

    echo $output;
  }

}



    public function admin_register_ans(){
        $this->check_if_logged_in();
       
        $subject = $_POST['subject'];
        $year = $_POST['year'];
        $ans = $_POST['ans'];
        $file_id = $_POST['file_id'];
        $paper = $_POST['paper'];
        $id = $_POST['id'];

        $file_id = $subject.'_'.$year;
        create_directory($paper.'_ans');
        create_file($paper.'_ans', $file_id);
       
        $check_ans_status = false;
     
        if($this->adminModel->find_ans($paper, $subject, $year)){
          $check_ans_status = $this->adminModel->add_ans($paper, $subject, $year, $id, $file_id);

          $this->adminModel->update_ans_col($paper, $id);

          if($check_ans_status){
            $path_file = file_path($paper.'_ans', $file_id);
            $array_data = open_file($paper.'_ans', $file_id);
      
                $insert = array(
                  'subject' => $subject,
                  'year' => $year,
                  'file' => $file_id,
                  'ans' => $ans
                );

                $array_data[] = $insert;
                $store_data = json_encode($array_data);

              if(file_put_contents($path_file, $store_data)){
                  echo true;  
              }

          }else{
            echo '404';
          }
          
        }else{
          echo '404';
        }
        
  }





  public function delete_result($id){
    if($this->adminModel->admin_delete_result($id)){
      flash('deleted', 'Result has been deleted');
      redirect('admins/all_results');
    }
  }





  public function reg_users(){
    $this->check_if_logged_in();

    $result = $this->adminModel->all_reg_users();
    $data = [
      'all_users' => $result
    ];
   
    $this->view('admin/reg_users', $data);
  }


  public function delete_user($id){
    $this->check_if_logged_in();
    if($this->adminModel->admin_delete_user($id)){
      flash('deleted', 'User has been deleted');
      redirect('admins/reg_users');
    }
  }


  
  public function edit_ans($paper, $id){
    $this->check_if_logged_in();
    $current_ans = [];
    $optional_msg = '';
    $db_question = $this->adminModel->show_one_question($paper, $id);
    if(!empty($db_question)){
      $question_file = open_file($paper, $db_question->file_id);
      if(!empty($question_file)){

        $show_ans = $this->adminModel->show_one_ans($paper, $id);

        if(!empty($show_ans)){
          if(check_file_exist($paper.'_ans', $show_ans->file_id)){
            $ans_file = open_file($paper.'_ans', $show_ans->file_id);
            if(!empty($ans_file)){
              foreach ($ans_file as $value) {
                $current_ans = $value->ans;
              }
            }else{
              $optional_msg = 'This quiz answer have not been registered';
            }

          }
        }

      }else{
          $current_ans = ['No Question Found', 102];
      }
    }else{
      $current_ans = ['No Question Found on the Database', 103];
    }

    $data = [
      'current_ans' =>  $current_ans,
      'question_file' => $question_file,
      'db_question' => $db_question,
      'op_msg' => $optional_msg,
      'paper_name' => $paper
    ];

    $this->view('admin/edit_ans', $data);
  }




  






    
    public function edit_question(){
      $this->check_if_logged_in();

      $paper = $_POST['paper'];
      $question_name = $this->test_input($_POST['quest']);
      $file_id = $_POST['id'];
      $num = $_POST['num'];
      $options = $_POST['options'];

      $open_json = open_file($paper, $file_id);
      $path_file = file_path($paper, $file_id);

      $arr_options = array();

      for($i = 0; $i < count($options); $i++){
          array_push($arr_options, $options[$i + 1]);
          $i++;
      }

      foreach ($open_json as $value) {
        if($value->id == $num){
          $value->question = $question_name;
          $value->options = $arr_options;
        }
        
      }


      $store_data = json_encode($open_json);
      if(file_put_contents($path_file, $store_data)){
        echo true;  
      }else{
        echo false;
      }
    }


    public function all($paper){
      $this->check_if_logged_in();
      $all = $this->adminModel->show_all($paper);

      $data = [
        'all' => $all,
        'paper' => $paper
      ];

      $this->view('admin/all', $data);
    }

    public function paginate($paper, $page){

    }


    public function edit($paper, $id){
      $this->check_if_logged_in();
      $db_paper = $this->adminModel->show_one_question($paper, $id);
      $paper_file = open_file($paper, $db_paper->file_id);
      $total_question = (!empty($paper_file)) ? count($paper_file) : 0;

      $count = 0;

      $data = [
        'current_paper' => $paper_file[$count],
        'db_paper' => $db_paper,
        'total_question' => $total_question,
        'paper_name' => $paper,
        'preview' => $paper_file
      ];

      $this->view('admin/edit', $data);
    }

    public function edit_on($paper, $id, $current_count){
      $this->check_if_logged_in();

      $db_paper = $this->adminModel->show_one_question($paper, $id);
      $paper_file = open_file($paper, $db_paper->file_id);

      $count = $current_count;

      $data = [
        'current_paper' => $paper_file[$count],
        'db_paper' => $db_paper,
        'total_question' => count($paper_file),
        'paper_name' => $paper,
        'preview' => $paper_file
      ];

      $this->view('admin/edit', $data);
    }


    public function delete($paper, $id){
      $this->check_if_logged_in();
      $paper_file = $this->adminModel->show_one_question($paper, $id);
      if($this->adminModel->delete($paper, $id)){
          $file = open_file($paper, $paper_file->file_id);
          foreach ($file as $value) {
            if($value->diagram){
              delete_diagram_file($value->img);
            }
          }
          delete_file($paper, $paper_file->file_id);
          $this->del_question_ans($paper, $id);
      }
      flash('deleted', 'Data has been deleted');
      redirect('admins/all/'.$paper);
    }


    public function del_question_ans($paper, $id){
      $show_one_ans = $this->adminModel->show_one_ans($paper, $id);
      delete_file($paper.'_ans', $show_one_ans->file_id);

    }

    public function ans($paper){
      $this->check_if_logged_in();
      $all_paper = $this->adminModel->show_all($paper);

      $check_array = [];

      $data = [
        'all_paper' => $all_paper,
        'paper_name' => $paper,
      ];

      $this->view('admin/ans', $data);
    }


    public function reg_ans($paper, $id){
      $this->check_if_logged_in();

      $db_paper = $this->adminModel->show_one_question($paper, $id);
      $paper_file = open_file($paper, $db_paper->file_id);

      $data = [
        'question' => $paper_file,
        'db_paper' => $db_paper,
        'paper_name' => $paper
      ];

      $this->view('admin/reg_ans', $data);
    }

      
  public function add($paper){
    $this->check_if_logged_in();
    $data = [
      'paper' => $paper
    ];

    $this->view('admin/add', $data);
  }

    
    

    
  
    public function admin_edit_ans(){
      $this->check_if_logged_in();
     
      $subject = $_POST['subject'];
      $year = $_POST['year'];
      $file_id = $_POST['file_id'];
      $paper = $_POST['paper'];
      $ans = $_POST['ans'];
      $id = $_POST['id'];

      $show_one_ans = $this->adminModel->show_one_ans($paper, $id);
      $path_file = file_path($paper.'_ans', $show_one_ans->file_id);
      
      if(isset($_POST['ans'])){
          $json_result =  open_file($paper.'_ans', $show_one_ans->file_id);
        
          foreach ($json_result as $value) {
            if($value->subject == $subject){
              if($value->year == $year){
                $value->ans = $ans;
              }
            }
          }

          $store_data = json_encode($json_result);
          if(file_put_contents($path_file, $store_data)){
            echo true;  
          }else{
            echo false;
          }
      }
  
  }

    


/*=========== end of Jamb section ============*/





    
/* ========== Waec Section =============== */

  public function add_waec(){
    $this->check_if_logged_in();
    $this->view('admin/add_waec');
  }
  
/*=========== end of Jamb section ============*/






    
/* ========== Waec Section =============== */

public function add_neco(){
  $this->check_if_logged_in();
  $this->view('admin/add_neco');
}

/*=========== end of Jamb section ============*/




    
public function add_question(){
  $this->check_if_logged_in();
  $alert_back = [];

  if(isset($_POST['quest'])){
    $file_id = $_POST['file'];
    $paper = $this->test_input($_POST['paper']);
    $question = $this->test_input($_POST['quest']);
    $options = $_POST['options'];

    $arr_options = array();

    for($i = 0; $i < count($options); $i++){
        array_push($arr_options, $options[$i + 1]);
        $i++;
    }

    if(check_file_exist($paper, $file_id)){
      $path_file = file_path($paper, $file_id);
      $array_data = open_file($paper, $file_id);
      $id = 1;

      $insert = array(
        'diagram' => false,
        'id' => $id,
        'question' => $question,
        'options' => $arr_options
      );

        if(!empty($array_data)){
            foreach($array_data as $data){
                $id = $data->id;
            }
            $id++;
            $insert['id'] = $id;
            array_push($array_data, $insert);
            $store_data = json_encode($array_data);
        }else{
          $array_data[] = $insert;
          $store_data = json_encode($array_data);
        }

        if(file_put_contents($path_file, $store_data)){
            echo true;  
        }
       
    }else{
      echo '404';
    }  
  }else{
    $alert_back[] = "Enter the question";
    echo $alert_back;
  }

}


  public function filters($paper, $subject, $from, $to){
    $filter = $this->adminModel->filter_paper($paper, $subject, $from, $to);

    $data = [
      'filter' => $filter,
      'paper' => $paper
    ];

    $this->check_if_logged_in();
    $this->view('admin/filter', $data);
  }


  public function show($paper, $id){
    $this->check_if_logged_in();

    $check = false;

    $db_detail = $this->adminModel->get_file_by_id($paper, $id);
    $check_ans = $this->adminModel->check_ans($paper, $db_detail->subject, $db_detail->year);


    if($check_ans != 0){
        $check = true;
    }

    $file = open_file($paper, $db_detail->file_id);
    $file_count = 0;

    if(!empty($file)){
      $file_count = count($file);
    }

    if($check){
      $get_ans = $this->adminModel->show_one_ans($paper, $id);
      $ans = open_file($paper.'_ans', $get_ans->file_id);
    }else{
      $ans = '';
    }

    $data = [
      'questions' => $file,
      'details' => $db_detail,
      'avaliable_ans' => $check_ans,
      'paper' => $paper,
      'avail_ans' => $check,
      'ans' => $ans,
      'file_count' => $file_count
    ];

    $this->view('admin/show', $data);
  }



}





