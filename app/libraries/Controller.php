<?php
// De parent controllerclass laad de model en view
class Controller
{
    public function Model($model)
    {
        // Pad naar de modelclass bestand opgeven
        require_once '../app/models/' . $model . '.php';

        // Nieuw object van de opgegeven model
        return new $model();
    }

    public function View($view, $data = [])
    {
        if(file_exists('../app/views/' . $view . '.php'))
        {
            require_once('../app/views/' . $view . '.php');
        } else {
            die('view does not exist');
        }
    }
}

?>