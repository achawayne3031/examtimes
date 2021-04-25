

<?php

class Users extends Controller{

    private $quiz_ans = "quiz_ans";

    public function __construct(){
        $this->userModel = $this->model('User');
    }

    public function register(){
        ///// check for POST
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //// process form

            //////// Sanitize the POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            ///// init data
            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            //// Validate Email
            if(empty($data['email'])){
                $data['email_err'] = 'Please enter email';
            }else{
                if($this->userModel->findUserByEmail($data['email'])){
                    $data['email_err'] = 'Email has been taken';
                }
            }

            //// Validate name
            if(empty($data['name'])){
                $data['name_err'] = 'Please enter name';
            }

            /////// Validate Password
            if(empty($data['password'])){
                $data['password_err'] = 'Please enter password';
            }elseif(strlen($data['password']) < 6){
                $data['password_err'] = 'Password must be at least 6 characters';
            }

            ///// Validate Confirm password
            if(empty($data['confirm_password'])){
                $data['confirm_password_err'] = 'Please enter confirm password';
            }else{
                if($data['password'] != $data['confirm_password']){
                    $data['confirm_password_err'] = 'Password do not match';
                }
            }


            ///////// Make sure errors are empty
            if(empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])){
                ////// Validated

               /// Hash password
               $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

               if($this->userModel->register($data)){
                    flash('register_success', 'You are registered and can log in');
                    redirect('users/login');
               }else{
                   die('Something went wrong');
               }

            }else{
                //// Load views with error
                $this->view('users/register', $data);
            }

        }else{
            ///// load form
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            $this->view('users/register', $data);
        }
    }


    public function login(){
        ///// check for POST
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            //// process form

            //////// Sanitize the POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            ///// init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
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

            ///// check email/user
            if($this->userModel->findUserByEmail($data['email'])){

            }else{
                $data['email_err'] = 'no user found';
            }


            ///////// Make sure errors are empty
            if(empty($data['email_err']) && empty($data['password_err'])){
                ////// Validated
                //die("SUCCESS");

                //////Check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if($loggedInUser){
                    //// Create session
                    $this->createUserSession($loggedInUser);
                }else{
                    $data['password_err'] = 'password incorrect';
                    $this->view('users/login', $data);
                }

            }else{
                //// Load views with error
                $this->view('users/login', $data);
            }


        }else{
            ///// load form
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
               
            ];

            $this->view('users/login', $data);

        }
    }


    public function createUserSession($user){
        session_start();
        $_SESSION['user_id'] = $user->user_id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('users/dashboard');
    }

    public function logout(){
        session_start();
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);

        session_destroy();
        redirect('users/login');
    }

    public function check_if_logged_in(){
        if(!isset($_SESSION['user_id'])){
            redirect('users/login');
        }

    }


    public function dashboard(){
        $this->check_if_logged_in();
        $all_quiz = $this->userModel->get_all_quiz();
        $quiz_num = count($all_quiz);
        $quiz_taken = $this->userModel->get_all_quiz_taken($_SESSION['user_id']);

        $data = [
            'all_quiz' => $all_quiz,
            'quiz_count' => $quiz_num,
            'quiz_taken' => $quiz_taken
        ];

        $this->view('users/dashboard', $data);
    }

    public function update_visited($id){


    }

    public function take_quiz($id){
        $this->check_if_logged_in();

        $this->userModel->update_quiz_visited($id);

        $resultDb = $this->userModel->get_current_quiz($id);
        $result = "";
        $result = $this->open_json($id);
        $check_if_quzi_ans = false;

        $ans = $this->open_json($this->quiz_ans);

        foreach ($ans as $value) {
            if($value->quiz_id == $id){
                $check_if_quzi_ans = true;
            }
        }

        $data = [
            'current_quiz' => $result,
            'id' => $id,
            'resultDb' => $resultDb,
            'avaliable_ans' => $check_if_quzi_ans
        ];

        $this->view('users/take_quiz', $data);
    }

        
    public function json_file_path($id){
        return DEFAULTROOT .'/public/logs/'.$id.'.json';
    } 


    
  public function open_json($id){
    if(file_exists(DEFAULTROOT .'/public/logs/'.$id.'.json')){
      $data = file_get_contents(DEFAULTROOT .'/public/logs/'.$id.'.json');
      return $array_data = json_decode($data);
    }

  }



    public function process_user_result(){

        $ans = $_POST['userAns'];
        $quiz_id = $_POST['quizId'];
        $quiz_name = $_POST['quizName'];
        $scores = 0;
  
        $this->userModel->update_submited_quiz($quiz_id);

        if($this->userModel->check_user_current_quiz_result($quiz_id, $_SESSION['user_id'])){
               $quiz_ans = $this->open_json($this->quiz_ans);

               foreach ($quiz_ans as  $value) {
                  if($value->quiz_id == $quiz_id){
                        for($i = 0; $i < count($value->ans); $i++){
                            if($value->ans[$i] == $ans[$i]){
                                $scores++;
                            }
                        }
                  }
               }


            if($this->userModel->insert_user_quiz_result($_SESSION['user_id'], $quiz_name, $quiz_id, $scores)){
                echo true;
            }else{
                echo '404';
            }


        }else{
            echo "404";
        }

    }




    public function user_result(){
        $result = $this->userModel->get_all_quiz_taken($_SESSION['user_id']);

        $data = [
            'results' => $result
        ];

        $this->view('users/user_result', $data);
    }


    public function re_take_quiz($id){
        $this->check_if_logged_in();

        $resultDb = $this->userModel->get_current_quiz($id);
        $result = "";
        $result = $this->open_json($id);
        $check_if_quiz_ans = false;

        $ans = $this->open_json($this->quiz_ans);

        foreach ($ans as $value) {
            if($value->quiz_id == $id){
                $check_if_quiz_ans = true;
            }
        }

        $data = [
            'current_quiz' => $result,
            'id' => $id,
            'resultDb' => $resultDb,
            'avaliable_ans' => $check_if_quiz_ans
        ];

        $this->view('users/re_take_quiz', $data);
    }
   



    public function process_user_re_take_result(){

        $ans = $_POST['userAns'];
        $quiz_id = $_POST['quizId'];
       // $quiz_name = $_POST['quizName'];
        $scores = 0;
     
        $quiz_ans = $this->open_json($this->quiz_ans);
        foreach ($quiz_ans as  $value) {
            if($value->quiz_id == $quiz_id){
                for($i = 0; $i < count($value->ans); $i++){
                    if($value->ans[$i] == $ans[$i]){
                        $scores++;
                    }
                }
            }
        }

        if($this->userModel->update_user_result($_SESSION['user_id'], $quiz_id, $scores)){
            echo true;
        }else{
            echo '404';
        }

    }



}


?>