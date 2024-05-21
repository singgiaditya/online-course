<?php
class Controller {
    public function view(string $view, $data = []){
        extract($data);
        require_once 'app/views/'.$view.'.view.php';
    }
}