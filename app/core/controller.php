<?php
class Controller extends Database{

    public function model($model){
        require_once 'app/models/' . $model . '.php';
        return new $model;
    }

    public function view($view,$model=[]){
        require_once 'app/views/' . $view . '.php';
    }

     
}