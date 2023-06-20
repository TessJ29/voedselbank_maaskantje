<?php
// De parent controllerclass laad de model en de view
class Controller
{
   public function model($model)
   {
     // Pad naar de modelclass bestand opgeven
       require_once APPROOT . '/models/' . $model . '.php';
     // Nieuwe object van de opgegeven model
       return new $model();
   }
   public function view($view, $data = [])
   {
    
      if(file_exists(APPROOT . '/views/' . $view . '.php'))
      {
          require_once(APPROOT . '/views/' . $view . '.php');
      } else {
        die('View bestaat niet');
      }
   }
}