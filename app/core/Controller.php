<?php 

class Controller {
  public function view($view, $data = [])
  {
    require_once '../app/views/' . $view . '.php';
  }

  public function model($model)
  {
    // var_dump($model); die;
    require_once '../app/models/' . $model . '.php';
    return new $model;
  }
}