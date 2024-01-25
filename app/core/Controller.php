<?php
    class Controller{

        // load view
       public function view($viewname,$data=[])
        {  
           extract($data);

           if(file_exists("../app/views/".$viewname.".php")){
               require ("../app/views/".$viewname.".php");
           }else{
               require ("../app/views/main/404view.php");
           } }

        // load model
        public function loadmodel($modelname)
        {
            if(file_exists("../app/models/".$modelname.".php")){
                require ("../app/models/".$modelname.".php");
                return $modelname = new $modelname();
            }else{
                return file_get_contents("../app/views/main/404view.php");
            }
        }

        // redirect
        public function redirect($link)
        {
            header("Location: ".trim($link,"/"));
            exit();
        }
    }

?>