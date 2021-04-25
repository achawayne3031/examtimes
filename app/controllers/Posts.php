

<?php

 class Posts extends Controller{


    public function __construct(){

        if(!isLoggedIn()){
            redirect('users/login');
         }

        $this->postModel = $this->model('Post');
        $this->userModel = $this->model('User');
    }

    public function index(){
        ///// get posts
        $post = $this->postModel->getPosts();
        $data = [
            'post' => $post
        ];
        $this->view('posts/index', $data);
    }


    public function add(){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

          //////// Sanitize the POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            if(empty($data['title'])){
                $data['title_err'] = 'Enter the title';
            }

            if(empty($data['body'])){
                $data['body_err'] = 'Enter the body';
            }

            if(empty($data['title_err']) && empty($data['body_err'])){
                if($this->postModel->addPost($data)){
                    redirect('posts');
                }else{
                    die('Something went wrong, Try again');
                }
                
            }
            $this->view('posts/add', $data);

        }else{
            $data = [
                'title' => '',
                'body' => ''
            ];
            $this->view('posts/add', $data);
        }
    }


    
    public function edit($id){

        if($_SERVER['REQUEST_METHOD'] == "POST"){

          //////// Sanitize the POST
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'title' => trim($_POST['title']),
                'body' => trim($_POST['body']),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => ''
            ];

            if(empty($data['title'])){
                $data['title_err'] = 'Enter the title';
            }

            if(empty($data['body'])){
                $data['body_err'] = 'Enter the body';
            }

            if(empty($data['title_err']) && empty($data['body_err'])){
                if($this->postModel->updatePost($data)){
                    redirect('posts');
                }else{
                    die('Something went wrong, Try again');
                }
                
            }
            $this->view('posts/edit', $data);

        }else{
            //// Get existing post from the model
            $post = $this->postModel->getPostById($id);

            ///// Check owner
            if($post->user_id != $_SESSION['user_id']){
                redirect('posts');
            }

            $data = [
                'id' => $id,
                'title' => $post->title,
                'body' => $post->body
            ];
            $this->view('posts/edit', $data);
        }
    }







    public function show($id){
        $post = $this->postModel->getPostById($id);
        $user = $this->userModel->getUserById($post->user_id);
        $data = [
            'post' => $post,
            'user' => $user
        ];

        $this->view('posts/show', $data);
    }



    public function delete($id){
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            
             //// Get existing post from the model
             $post = $this->postModel->getPostById($id);

             ///// Check owner
             if($post->user_id != $_SESSION['user_id']){
                 redirect('posts');
             }


            if($this->postModel->deletePost($id)){
                redirect('posts');
            }else{
                die("Something went wrong");
            }
        }else{
            redirect('posts');
        }
    }



 }