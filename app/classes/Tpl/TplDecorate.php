<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 09.04.2018
 * Time: 8:00
 */

namespace Tpl;

spl_autoload_register(function ($class){
    if (strpos($class, "Ex")){
        $class = "app/exceptions/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
    elseif(strpos($class, "Op")){
        $class = "app/classes/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
    elseif(strpos($class, "Validator")){
        $class = "app/classes/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
    else {
        $class = "app/classes/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
});

use TemplateEx\TemplateException as TemEx;

class TplDecorate {

    private $file = null;

    public function __construct($file){
        trim($file);
        file_get_contents($file);
    }

    public function Decorate(){
        echo $this->file;
        /*if (file_exists($file)){
            echo $this->file = $file;
        }
        else throw new TemEx("Error with decorate");*/
    }

} 