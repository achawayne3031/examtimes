




<?php


    function delete_diagram_file($path){
        if(file_exists(DEFAULTROOT.$path)){
            unlink(DEFAULTROOT.$path);
        }
    }



    function check_file_exist($paper, $file_name){
       return file_exists(DEFAULTROOT .'/public/logs/'.$paper .'/'.$file_name.'.json');
    }

    

    function file_path($paper, $file_name){
        return DEFAULTROOT .'/public/logs/'.$paper.'/'.$file_name.'.json';
    } 

    function img_file_path($paper, $file_name){
        return URLROOT .'/public/logs/'.$paper.'_diagrams/'.$file_name;
    }
    
    function open_file($paper, $file_name){
        if(file_exists(DEFAULTROOT .'/public/logs/'.$paper.'/'.$file_name.'.json')){
            $data = file_get_contents(DEFAULTROOT .'/public/logs/'.$paper.'/'.$file_name.'.json');
            return json_decode($data);
        }
    }

 
    function delete_file($paper, $file_name){
        if(file_exists(DEFAULTROOT .'/public/logs/'.$paper.'/'.$file_name.'.json')){
            unlink(DEFAULTROOT .'/public/logs/'.$paper.'/'.$file_name.'.json');
        }

    }


    
    function create_directory($paper){
        if(!is_dir(DEFAULTROOT .'/public/logs/'.$paper)){
            mkdir(DEFAULTROOT .'/public/logs/'.$paper);
        }
    }


    
    function create_question_file($paper, $id){
        create_directory($paper);
    
        if(is_dir(DEFAULTROOT .'/public/logs/'.$paper)){
            $cur = fopen(DEFAULTROOT .'/public/logs/'.$paper .'/'.$id.'.json', 'w');
            fclose($cur);
        }
    }

    
    
    function create_file($dir, $paper){
       // create_directory($paper);
       if(!file_exists(DEFAULTROOT .'/public/logs/'.$dir .'/'.$paper.'.json')){
        $cur = fopen(DEFAULTROOT .'/public/logs/'.$dir .'/'.$paper.'.json', 'w');
        fclose($cur);
       }
       
    }


  



