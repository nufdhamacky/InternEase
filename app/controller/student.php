<?php

class Student extends Controller{

    public function index(){
        $this->view('_404');
    }

    public function dashboard(){
        $this->view('student/dashboard');

    }

    public function wishlist() {
        // Handle AJAX request to add/remove from wishlist
        $userId = $_POST['userId'];
        $adId = $_POST['adId'];
    
        // Instantiate the Wishlist model and perform the required operations
        $wishlistModel = $this->model('Wishlist');
        $wishlistModel->addToWishlist($userId, $adId);
    }

    public function notification(){
        
    }
    
    public function advertisement(){
        $userId = $_SESSION['userId'];
        $admodel = $this->model('Ads');
        $ads = $admodel->fetchAds();
        // $adsWithStatus = $admodel->fetchAdsWithStatus($userId);

        // var_dump($_SESSION);
        // var_dump($ads);
        $this->view('student/advertisement', ['data' => $ads]);

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

    public function notification(){
        $this->view('student/notification');
    }

    
    public function logout(){
        session_destroy();
        echo "<script> window.location.href='http://localhost/internease/public/home';</script>";
    }       
    }