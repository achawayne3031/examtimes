<?php


class Admin{

    private $db;
    private $admin_table = "admin";
    private $user_table = "users";
    private $quiz_table = "quiz_table";
    private $quiz_ans = "quiz_ans";
    private $users_result = "users_quiz_result";
    private $jamb_table = "jamb";
    private $page_visit = 'page_visit';

    public function __construct(){
        $this->db = new Database;
    }


    //////////// check reg email ///////////
    public function check_reg_email($email){
        $this->db->query("SELECT * FROM ". $this->admin_table ." WHERE email = :email");
        $this->db->bind(':email', $email);
        $row = $this->db->single();

        if(!empty($row)){
            return true;
        }else{
            return false;
        }

    }


    ///// login user
    public function login($email, $password){
        $this->db->query("SELECT * FROM ". $this->admin_table ." WHERE email = :email");
        $this->db->bind(':email', $email);


        $row = $this->db->single();

        if(!empty($row)){
            $hashed_password = $row->password;
            if(password_verify($password, $hashed_password)){
                return $row;
            }else{
                return false;
            }
        }else{
            return false;
        }
       
       

       

        
    }

    

    public function get_all_users_nums(){
        $this->db->query("SELECT * FROM " .$this->user_table);
        $result = $this->db->resultSet();

        return $result;
    }

    
    public function get_all_quiz_nums(){
        $this->db->query("SELECT * FROM " .$this->quiz_table);
        $result = $this->db->resultSet();

        return $result;
    }

    public function get_all_quiz_ans(){
        $this->db->query("SELECT * FROM " .$this->quiz_ans);
        $result = $this->db->resultSet();

        return $result;
    }

    public function get_all_results(){
        $this->db->query("SELECT * FROM " .$this->users_result);
        $result = $this->db->resultSet();

        return $result;
    }


    public function admin_delete_result($id){
        $this->db->query("DELETE FROM ". $this->users_result ." WHERE id = :id");
        $this->db->bind(':id', $id);
        
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }


    public function all_reg_users(){
        $this->db->query("SELECT * FROM " .$this->user_table);
        $result = $this->db->resultSet();

        return $result;
    }




    public function admin_delete_user($id){
        $this->db->query("DELETE FROM ". $this->user_table ." WHERE id = :id");
        $this->db->bind(':id', $id);
        
        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    
    public function find_ans($paper, $subject, $year){
        $this->db->query("SELECT * FROM " .$paper."_ans". " WHERE subject = :subject AND year = :year");
        $this->db->bind(':subject', $subject);
        $this->db->bind(':year', $year);

        $result = $this->db->resultSet();

        if(count($result) == 0){
            return true;
        }else{
            return false;
        }
    }

    

    function add_ans($paper, $subject, $year, $id, $file_id){
        $this->db->query('INSERT INTO '. $paper.'_ans' .' (subject, year, subject_id, file_id) VALUES
        (:subject, :year, :subject_id, :file_id)');
        ////// bind values
        $this->db->bind(':subject', $subject); 
        $this->db->bind(':year', $year); 
        $this->db->bind(':subject_id', $id);
        $this->db->bind(':file_id', $file_id); 
 

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }




    public function add_subject($paper, $subject, $year, $timer, $mark){
        $subject = str_replace(' ', '', $subject);
        $file_id = $paper.'_'.$subject.'_'.$year.'_'.time();

        $this->db->query('INSERT INTO '. $paper .' (subject, year, timer, mark, file_id) VALUES
        (:subject, :year, :timer, :mark, :id)');
        ////// bind values
        $this->db->bind(':subject', $subject); 
        $this->db->bind(':year', $year); 
        $this->db->bind(':timer', $timer); 
        $this->db->bind(':mark', $mark); 
        $this->db->bind(':id', $file_id); 
        $return_data = [
            'success' => true,
            'file_id' => $file_id
        ];

        if($this->db->execute()){
            return $return_data;
        }else{
            return false;
        }
    }

    public function page_visit(){
        $this->db->query("SELECT * FROM " .$this->page_visit);

        $result = $this->db->resultSet();
        return $result;
    }




    public function check_subject_ans($paper, $subject, $year){
        $this->db->query("SELECT * FROM " .$paper . " WHERE subject = :subject AND year = :year");
        $this->db->bind(':subject', $subject);
        $this->db->bind(':year', $year);

        $result = $this->db->resultSet();
        $result = count($result);
        return $result;
    }

    public function update_ans_col($paper, $id){
        $this->db->query("UPDATE ".$paper." SET ans = :ans WHERE id = :id");
        $this->db->bind(':ans', 1);
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    
    public function find_subject($paper, $subject, $year){
        $this->db->query("SELECT * FROM " .$paper . " WHERE subject = :subject AND year = :year");
        $this->db->bind(':subject', $subject);
        $this->db->bind(':year', $year);

        $result = $this->db->resultSet();
        return count($result);
    }

    public function show_all($paper){
        $this->db->query("SELECT * FROM " .$paper ." ORDER BY subject ASC");

        $result = $this->db->resultSet();
        return $result;
    }

    public function filter_paper($paper, $subject, $from, $to){
        $this->db->query("SELECT * FROM " .$paper . " WHERE subject LIKE :subject AND year BETWEEN :from AND :to");
        $this->db->bind(':subject', $subject);
        $this->db->bind(':from', $from);
        $this->db->bind(':to', $to);

        $result = $this->db->resultSet();
        return $result;

    }


    public function all_paper_ans($paper){
        $this->db->query("SELECT * FROM " .$paper.'_ans');

        $result = $this->db->resultSet();
        return $result;
    }




    
    public function delete($paper, $id){
        $this->db->query("DELETE FROM ". $paper ." WHERE id = :id");
        $this->db->bind(':id', $id);

        if($this->db->execute()){
          ///  $this->delete_quiz_ans($id);
            return true;
        }else{
            return false;
        }
    }


    
    public function show_one_question($paper, $id){
        $this->db->query("SELECT * FROM " .$paper. " WHERE id = :id");
        $this->db->bind(':id', $id);

        $result = $this->db->single();
        return $result;
    }


    
    public function show_one_ans($paper, $id){
        $this->db->query("SELECT * FROM " .$paper."_ans". " WHERE subject_id = :id");
        $this->db->bind(':id', $id);
        
        $result = $this->db->single();
        return $result;
    }

    
    public function get_file_by_id($paper, $id){
        $this->db->query("SELECT * FROM " .$paper. " WHERE id = :id");
        $this->db->bind(':id', $id);
        
        $result = $this->db->single();
        return $result;
    }


    public function check_ans($paper, $subject, $year){
        $this->db->query("SELECT * FROM ".$paper."_ans WHERE subject = :subject AND year = :year");
        $this->db->bind(':subject', $subject);
        $this->db->bind(':year', $year);

        $row = $this->db->resultSet();
        $count_ans = count($row);
        return $count_ans;
    }

    
    // public function show_one_ans($paper, $id){
    //     $this->db->query("SELECT * FROM " .$paper."_ans". " WHERE subject_id = :id");
    //     $this->db->bind(':id', $id);
        
    //     $result = $this->db->single();
    //     return $result;
    // }


    /* ========== Jamb Section =============== */
    public function show_all_jamb(){
        $this->db->query("SELECT * FROM " .$this->jamb_table);

        $result = $this->db->resultSet();
        return $result;
    }


    public function delete_jamb($id){
        $this->db->query("DELETE FROM ". $this->jamb_table ." WHERE id = :id");
        $this->db->bind(':id', $id);

        if($this->db->execute()){
          ///  $this->delete_quiz_ans($id);
            return true;
        }else{
            return false;
        }
    }






    /*=========== end of Jamb section ============*/


}