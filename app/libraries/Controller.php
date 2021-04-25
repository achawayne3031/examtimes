

<?php

    /*
    * Load Controller
    * load models and views
    */

    class Controller{

        ////load model
        public function model($model){
            ////Require model file
            require_once '../app/models/' . $model . '.php';

            /////Insantiate model
            return new $model();

        }


        //////Load the view
        public function view($view, $data = []){
            ////Check the view file
            if(file_exists('../app/views/' . $view . '.php')){
                require_once '../app/views/' . $view . '.php';
            }else{
                ////view do not exist
                die("view do not exist");
            }
        }


    }