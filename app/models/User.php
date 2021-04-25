
<?php


    class User{

        private $db;
        private $user_table = "users";
        private $jamb_table = "jamb";
        private $quiz_table = "quiz_table";
        private $user_ans_table = "users_quiz_result";

        public function __construct(){
            $this->db = new Database;
        }

        ///// login user
        public function login($email, $password){
            $this->db->query("SELECT * FROM ". $this->user_table ." WHERE email = :email");
            $this->db->bind(':email', $email);

            $row = $this->db->single();

            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)){
                return $row;
            }else{
                return false;
            }
        }

        //////// register user
        public function register($data){

            $chained_name = explode(" ", $data['name']);
            $user_id = $chained_name[0].time();

            $this->db->query('INSERT INTO '. $this->user_table .' (name, email, password, user_id) VALUES
            (:name, :email, :password, :user_id)');
            ////// bind values
            $this->db->bind(':name', $data['name']); 
            $this->db->bind(':email', $data['email']); 
            $this->db->bind(':password', $data['password']);
            $this->db->bind(':user_id', $user_id);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }



        /////// Check user by email
        public function findUserByEmail($email){
            $this->db->query("SELECT * FROM ". $this->user_table ." WHERE email = :email");
            $this->db->bind(':email', $email);

            $this->db->single();

            //// Check row
            if($this->db->rowCount() > 0){
                return true;
            }else{
                return false;
            }

        }


        public function getUserById($id){
            $this->db->query("SELECT * FROM users WHERE id = :id");
            $this->db->bind(':id', $id);
            $row = $this->db->single();

            return $row;
        }


        public function get_all_quiz(){
            $this->db->query("SELECT * FROM " .$this->quiz_table);
            $result = $this->db->resultSet();

            return $result;
        }


        public function get_current_quiz($id){
            $this->db->query("SELECT * FROM ".$this->quiz_table." WHERE quiz_id = :id");
            $this->db->bind(':id', $id);
            $row = $this->db->single();

            return $row;
        }

        public function get_all_quiz_taken($id){
            $this->db->query("SELECT * FROM ".$this->user_ans_table." WHERE user_id = :id");
            $this->db->bind(':id', $id);
            $result = $this->db->resultSet();
           // $result_num = count($result);

            return $result;
        }

        public function check_user_current_quiz_result($quiz, $user_id){

            $this->db->query("SELECT * FROM " .$this->user_ans_table . " WHERE quiz_id = :quiz AND user_id = :user_id");
            $this->db->bind(':quiz', $quiz);
            $this->db->bind(':user_id', $user_id);

            $result = $this->db->resultSet();
            if(count($result) == 0){
                return true;
            }else{
                return false;
            }

        }


        public function insert_user_quiz_result($user, $name, $quiz, $scores){
            $this->db->query('INSERT INTO '. $this->user_ans_table .' (user_id, quiz_name, quiz_id, scores) VALUES
            (:user, :name, :quiz, :scores)');
            ////// bind values
            $this->db->bind(':user', $user); 
            $this->db->bind(':name', $name); 
            $this->db->bind(':quiz', $quiz); 
            $this->db->bind(':scores', $scores);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }


        public function update_user_result($user, $quiz, $scores){
            $this->db->query('UPDATE '. $this->user_ans_table .' SET scores = :score WHERE user_id = :user AND quiz_id = :quiz');
            ////// bind values
            $this->db->bind(':user', $user); 
            $this->db->bind(':quiz', $quiz); 
            $this->db->bind(':score', $scores);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }



        public function update_quiz_visited($id){
            $current = $this->get_current_quiz($id);
            $count = $current->visited + 1;

            $this->db->query('UPDATE '. $this->quiz_table .' SET visited = :count WHERE quiz_id = :id');
            ////// bind values
            $this->db->bind(':id', $id); 
            $this->db->bind(':count', $count); 
           
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }

        public function update_submited_quiz($id){
            $current = $this->get_current_quiz($id);
            $count = $current->submitted + 1;

            $this->db->query('UPDATE '. $this->quiz_table .' SET submitted = :count WHERE quiz_id = :id');
            ////// bind values
            $this->db->bind(':id', $id); 
            $this->db->bind(':count', $count); 
           
            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }






    }