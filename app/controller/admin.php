<?php

class admin extends Controller{

    public function logout(){
        session_destroy();
        echo "<script> window.location.href='http://localhost/internease/public/home/index';</script>";
    }
}

?>