

<?php


    class Pages extends Controller{

       /// private $postModel;
        public function __construct(){

          $this->pageModel = $this->model('Page');

        }
        

        
        public function index(){
          // if(isLoggedIn()){
          //   redirect('posts');
          // }
          $data = ['title' => 'Welcome'];
          
        $page_status = $this->pageModel->find_page('home');
        if($page_status){
          $this->pageModel->add_page('home', '/');
        }else{
          $this->pageModel->update_page('home');
        }

          $this->view('pages/index', $data);
        }

        

        public function about(){
            $data = [
              'title' => 'About Page'
            ];
           $this->view('pages/about', $data);
        }

        

    public function get_year(){
      if($_SERVER['REQUEST_METHOD'] == "POST"){
          $subject = $_POST['subject'];
          $table_name = $_POST['table'];
          $result = $this->pageModel->get_subjects($table_name, $subject);
          $year = [];
          foreach ($result as $value) {
              array_push($year, $value->year);
          }
          sort($year);
          echo json_encode($year);
      }
    }


        

    public function jamb(){
      $row = $this->pageModel->get_jamb();
      $get_all_subject = [];
      foreach ($row as $value) { 
          array_push($get_all_subject, $value->subject); 
      }
      sort($get_all_subject);
      $sort_subject = array_unique($get_all_subject);

      $status = false;

      if(empty($get_all_subject)){
        $status = true;
      }

      $data = [
        'jamb' => $sort_subject,
        'status' => $status
      ];

      
      $page_status = $this->pageModel->find_page('jamb');
      if($page_status){
        $this->pageModel->add_page('jamb', 'pages/jamb');
      }else{
        $this->pageModel->update_page('jamb');
      }


      $this->view('pages/jamb', $data);
    }





    public function waec(){
      $row = $this->pageModel->get_waec();
      $get_all_subject = [];
      foreach ($row as $value) { 
          array_push($get_all_subject, $value->subject); 
      }
      sort($get_all_subject);
      $sort_subject = array_unique($get_all_subject);

      $status = false;

      if(empty($get_all_subject)){
        $status = true;
      }

      $data = [
        'waec' => $sort_subject,
        'status' => $status
      ];

      
      $page_status = $this->pageModel->find_page('waec');
      if($page_status){
        $this->pageModel->add_page('waec', 'pages/waec');
      }else{
        $this->pageModel->update_page('waec');
      }



      $this->view('pages/waec', $data);
    }

    public function neco(){
      $row = $this->pageModel->get_neco();
      $get_all_subject = [];
      foreach ($row as $value) { 
          array_push($get_all_subject, $value->subject); 
      }
      sort($get_all_subject);
      $sort_subject = array_unique($get_all_subject);

      $status = false;

      if(empty($get_all_subject)){
        $status = true;
      }

      $page_status = $this->pageModel->find_page('neco');
      if($page_status){
        $this->pageModel->add_page('neco', 'pages/neco');
      }else{
        $this->pageModel->update_page('neco');
      }

      $data = [
        'neco' => $sort_subject,
        'status' => $status
      ];

      $this->view('pages/neco', $data);
    }

    public function take_test($paper, $subject, $year){
      $check = false;

      $db_detail = $this->pageModel->get_file($paper, $subject, $year);
      $check_ans = $this->pageModel->check_ans($paper, $subject, $year);
      $this->pageModel->update_visited($paper, $subject, $year);

      if($check_ans != 0){
          $check = true;
      }

      if($db_detail){
        $file = open_file($paper, $db_detail->file_id);
      }else{
        $file = [];
        $db_detail = [];
      }




      $data = [
        'questions' => $file,
        'details' => $db_detail,
        'avaliable_ans' => $check_ans,
        'paper' => $paper,
        'avail_ans' => $check,
        'active' => $check
      ];

      $this->view('pages/test', $data);
    }
 


    public function quick_process_user_result(){
      $scores = 0;
      $subject = $_POST['subject'];
      $year = $_POST['year'];
      $paper = $_POST['paper'];
      $ans = $_POST['ans'];

      $this->pageModel->update_submitted($paper, $subject, $year);
      $question_details = $this->pageModel->show_one_question($paper, $subject, $year);

      $get_ans = $this->pageModel->show_one_ans($paper, $question_details->id);
      
      $question_file = open_file($paper, $question_details->file_id);
      $total_question = count($question_file);

      $file_ans = open_file($paper.'_ans', $get_ans->file_id);

      foreach ($file_ans as  $value) {
        if($value->subject == $subject){
          if($value->year == $year){
            for($i = 0; $i < count($value->ans); $i++){
              if($value->ans[$i] == $ans[$i]){
                  $scores++;
              }
            }
          }
        }
      }

      $result = floatval(($scores / $total_question) * 100);
      echo substr($result, 0, 4).'%';
  }


        
  }