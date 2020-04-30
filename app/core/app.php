<?php

class App{

    protected $controller = 'home';
    protected $method = 'index';
    protected $model = [];

    public function __construct(){
        
        $url = $this->parseUrl();

        if(file_exists('app/controllers/' . $url[0] . '.php')){
            $this->controller = $url[0];
            unset($url[0]);
        }

        require_once 'app/controllers/' . $this->controller . '.php';

        $this->controller = new $this->controller;
        if(isset($url[1])){
            if(method_exists($this->controller,$url[1])){
                $this->method = $url[1];
                unset($url[1]);
            }
        }
        
        if(isset($url[2])){
            array_push($this->model,$url[2]);
            unset($url[2]);
            if(isset($url[3])){
                array_push($this->model,$url[3]);
                unset($url[3]);
            }
        }
        elseif(!empty($_POST)) {
            $tmp_model = [];
            $tmp_model['POST'] = $_POST;
            if(!empty($_FILES)){
                $tmp_model['FILES'] = $_FILES;
            }
            array_push($this->model,$tmp_model);
        }
        
        call_user_func_array([$this->controller, $this->method],$this->model);

    }

    public function parseUrl(){
        if(isset($_GET['url'])){
            $url = explode('/',filter_var(rtrim($_GET['url'],'/'),FILTER_SANITIZE_URL));
            return $url;
        }
    }
}