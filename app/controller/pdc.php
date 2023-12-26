<?php 

    class Pdc extends Controller {

        // public function isLoggedIn(){
        //     if(isset($_SESSION['userId']) && isset($_SESSION['userRole'])=="company"){
        //         return 1;
        //     } else{
        //         return 0;
        //     }
        // }

        public function dashboard(){

            //$isLoggedIn = $this->isLoggedIn();
            
           //if($isLoggedIn == 1){
                $this->view('pdc/dashboard');
           // } else{
                //$_SESSION['loginError'] = "Please login first !";
                //echo "<script> window.location.href='http://localhost/internease/public/home/login';</script>";
            //}
        
        }   
    }
