<?php
    class Controller{
        public function model($model) {
            require_once("./MVC_PHP/Model/".$model.".php");
            return new $model;
        }
        public function view($view, $data=[]) {
            require_once("./MVC_PHP/View/".$view.".php");
        }
    }
?>