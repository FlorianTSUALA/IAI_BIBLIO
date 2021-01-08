<?php

class Router{
    
    public $viewPath = "views";

    public static $appRoutes = [];

    public static function Get($name, $path, $directory=""){
        self::$appRoutes += ['name' => $name, 'path' => $path, 'dir' => $directory];
    }

    public static function Post($name, $path, $directory){
        self::$appRoutes += ['name' => $name, 'path' => $path, 'dir' => $directory];
    }

    public function call($page){
        
    }

    //$this->render('sections.cantine.abonnement_cantine', compact('prix_abonnements', 'type_paiements', 'eleves', 'classes'));

    public function render(String $nameView, array $variables = [], string $template = 'default')
    {
        $tmp_template = $template?? $this->template;

        ob_start();
        extract($variables);
        require $this->viewPath . str_replace('.', '/', $nameView) . '.php';
        $content = ob_get_clean();
        require ($this->viewPath . 'templates/' . $tmp_template . '.php');
    }
}