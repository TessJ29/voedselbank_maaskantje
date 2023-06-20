<?php
 class Core {
    // properties
    public $currentController = 'Landingpages';
    public $currentMethod = 'index';
    public $params = [];

    //Constructor
    public function __construct()
    {
        $url = $this->getURL();

       // var_dump($this->getURL());exit();
        
        // kijk if het controllerclass bestand bestaat

        if (file_exists(APPROOT . '/controllers/' . ucwords($url[0]) . '.php')){
            $this->currentController = ucwords($url[0]);
            unset($url[0]);
        }

        require_once APPROOT . '/controllers/' . $this->currentController . '.php';

        //Maak een nieuwe object 
        $this->currentController = new $this->currentController();

        
        if(isset($url[1]))
        {
           if(method_exists($this->currentController, $url[1]))
           {
              $this->currentMethod = $url[1];
              unset($url[1]);
           }
        }
        
        // Dit is de parameterlijst van je method in de controllerclass
        $this->params = $url ? array_values($url) : [];
        
        // Hier wordt de method in de controllerclass aangeroepen.
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);
    }

    public function getURL()
    {
        if (isset($_GET['url'])){
           
           $url = rtrim($_GET["url"], '/');

           $url = filter_var($url, FILTER_SANITIZE_URL);

           //echo $url;exit();

           $url = explode('/', $url);
           return $url;
        } else {
            return array('Landingpages', 'index');
        }
    }
 }
?>