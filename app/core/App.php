<?php

    class App { 

        protected $controller = 'home'; //default controller
        protected $method = 'index'; //default method
        protected $params = []; //default params


        //constructor function to parse url and call controller and method
        public function __construct() {
        
            session_start();
            
            $url = $this->parseUrl();


            if (isset($url[0]))
            {

                if(file_exists('../app/controller/' . $url[0] . '.php')) {
                    $this->controller = $url[0];
                    unset($url[0]);
                }

            }

            require_once '../app/controller/' . $this->controller . '.php';

            $this->controller = new $this->controller;
            
            if (isset($url[1]))
            {   

                if(method_exists($this->controller, $url[1])) {

                    $this->method = $url[1];
                    unset($url[1]);
                }
            }

            $this->params = $url ? array_values($url) : [];

            call_user_func_array([$this->controller, $this->method], $this->params);

        }

        public function parseUrl() {
            if(isset($_GET['url'])) {
                return $url = explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
            }
        }

    }