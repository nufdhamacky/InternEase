<?php

class Student extends Controller{
    public function dashboard(){
        $this->view('student/dashboard');

    }
    public function advertisement(){
        $this->view('student/advertisement');

    }
    public function profile(){
        $this->view('student/profile');

    }
    public function schedule(){
        $this->view('student/schedule');

    }
    public function selectionlist(){
        $this->view('student/selectionlist');
        $this->model('User');
        
    }
    
    public function logout(){
        session_destroy();
        echo "<script> window.location.href='http://localhost/internease/public/home';</script>";
    }       
    }