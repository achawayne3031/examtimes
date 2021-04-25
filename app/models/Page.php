



<?php


class Page{

    private $db;
    private $jamb_table = 'jamb';
    private $waec_table = 'waec';
    private $neco_table = 'neco';
    private $page_visits = 'page_visit';

    public function __construct(){
        $this->db = new Database;
    }

    public function getPosts(){
        $this->db->query("SELECT *,
                            posts.id as postId,
                            users.id as userId,
                            posts.created_at as postCreated,
                            users.created_at as userCreated
                            FROM posts
                            INNER JOIN users
                            ON posts.user_id = users.id
                            ORDER BY posts.created_at DESC
                            ");
        $results = $this->db->resultSet();
        return $results;
    }




    public function addPost($data){
        $this->db->query("INSERT INTO posts(user_id, title, body) VALUES(:user_id, :title, :body)");
        $this->db->bind(':user_id', $_SESSION['user_id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    
    public function updatePost($data){
        $this->db->query("UPDATE posts SET title = :title, body = :body WHERE id = :id");
        $this->db->bind(':id', $data['id']);
        $this->db->bind(':title', $data['title']);
        $this->db->bind(':body', $data['body']);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }



    public function getPostById($id){
        $this->db->query("SELECT * FROM posts WHERE id = :id");

        $this->db->bind(':id', $id);
        $row = $this->db->single();
        return $row;
    }


    public function deletePost($id){
        $this->db->query("DELETE FROM posts WHERE id = :id");
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }

    }

    
    public function get_subjects($table_name, $subject){
        $this->db->query("SELECT * FROM ".$table_name." WHERE subject = :subject");
        $this->db->bind(':subject', $subject);
        $result = $this->db->resultSet();

        return $result;
    }


    public function get_jamb(){
        $this->db->query("SELECT * FROM ".$this->jamb_table);

        $row = $this->db->resultSet();
        return $row;
    }

    public function get_waec(){
        $this->db->query("SELECT * FROM ".$this->waec_table);

        $row = $this->db->resultSet();
        return $row;
    }

    public function get_neco(){
        $this->db->query("SELECT * FROM ".$this->neco_table);

        $row = $this->db->resultSet();
        return $row;
    }


    public function get_file($paper, $subject, $year){
        $this->db->query("SELECT * FROM ".$paper." WHERE subject = :subject AND year = :year");
        $this->db->bind(':subject', $subject);
        $this->db->bind(':year', $year);

        $row = $this->db->single();
        return $row;
    }

    public function check_ans($paper, $subject, $year){
        $this->db->query("SELECT * FROM ".$paper."_ans WHERE subject = :subject AND year = :year");
        $this->db->bind(':subject', $subject);
        $this->db->bind(':year', $year);

        $row = $this->db->resultSet();
        $count_ans = count($row);
        return $count_ans;
    }

    public function update_visited($paper, $subject, $year){
        $this->db->query("SELECT * FROM ".$paper." WHERE subject = :subject AND year = :year");
        $this->db->bind(':subject', $subject);
        $this->db->bind(':year', $year);

        $row = $this->db->single();
        if($row){
            $current_visited = $row->visited;

            $new_visited = $current_visited + 1;
            $this->db->query("UPDATE ".$paper." SET visited = :new_visited WHERE subject = :subject AND year = :year");
            $this->db->bind(':new_visited', $new_visited);
            $this->db->bind(':subject', $subject);
            $this->db->bind(':year', $year);
            $this->db->execute();
        }
       

    }


    public function find_page($page_name){
        $this->db->query("SELECT * FROM ".$this->page_visits." WHERE name = :name");
        $this->db->bind(':name', $page_name);

        $row = $this->db->resultSet();
        if(count($row) == 0){
            return true;
        }else{
            return false;
        }
    }

    public function add_page($page_name, $url){
        $this->db->query("INSERT INTO ".$this->page_visits."(name, url, traffic) VALUES(:name, :url, :traffic)");
        $this->db->bind(':name', $page_name);
        $this->db->bind(':url', $url);
        $this->db->bind(':traffic', 1);

        $this->db->execute();
    }


    public function update_page($page_name){
        $this->db->query("SELECT * FROM ".$this->page_visits." WHERE name = :name");
        $this->db->bind(':name', $page_name);

        $row = $this->db->single();
        $current_traffic = $row->traffic;

        $new_traffic = $current_traffic + 1;
        $this->db->query("UPDATE ".$this->page_visits." SET traffic = :new_traffic WHERE name = :name");
        $this->db->bind(':new_traffic', $new_traffic);
        $this->db->bind(':name', $page_name);
        $this->db->execute();
    }

    public function update_submitted($paper, $subject, $year){
        $this->db->query("SELECT * FROM ".$paper." WHERE subject = :subject AND year = :year");
        $this->db->bind(':subject', $subject);
        $this->db->bind(':year', $year);

        $row = $this->db->single();
        if($row){
            $current_submitted = $row->submitted;

            $new_submitted = $current_submitted + 1;
            $this->db->query("UPDATE ".$paper." SET submitted = :new_submitted WHERE subject = :subject AND year = :year");
            $this->db->bind(':new_submitted', $new_submitted);
            $this->db->bind(':subject', $subject);
            $this->db->bind(':year', $year);
            $this->db->execute();
        }
        
    }


    
    public function show_one_question($paper, $subject, $year){
        $this->db->query("SELECT * FROM " .$paper. " WHERE subject = :subject AND year = :year");
        $this->db->bind(':subject', $subject);
        $this->db->bind(':year', $year);

        $result = $this->db->single();
        return $result;
    }


    
    
    public function show_one_ans($paper, $id){
        $this->db->query("SELECT * FROM " .$paper."_ans". " WHERE subject_id = :id");
        $this->db->bind(':id', $id);
        
        $result = $this->db->single();
        return $result;
    }



}