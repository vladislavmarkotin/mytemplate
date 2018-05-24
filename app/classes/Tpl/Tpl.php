<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 22.03.2018
 * Time: 7:36
 */
namespace  Tpl;

spl_autoload_register(function ($class){
    if (strpos($class, "Ex")){
        $class = "app/exceptions/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
    /*elseif(strpos($class, "Validator")){
        $class = "app/Tpl/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }*/
    else {
        $class = "app/classes/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }

});

use TemplateEx\TemplateException as TemEx;

/**
 * Class Tpl
 * @package Tpl
 * Единая точка доступа к шаблонизатору
 */

class Tpl {

    private static $instance = null;
    private $tpl_code = null;
    private $tpl_analyzer = null;
    private $file_path = null;
    private $ready_tpl = null;

    private function __construct($file_path){
        $this->file_path = $file_path;
    }

    private function __clone(){}



    /**
     * @param $file_path
     * Создаем сущность шаблонизатора. Фиксируем путь к шаблону
     */
    public static function getInstance($file_path){

        //echo $file_path;
        if(!Tpl::$instance)
        {
            Tpl::$instance = new Tpl($file_path);
            return Tpl::$instance;
        }

        return Tpl::$instance;

    }

    public function init(){
        if ( file_exists($this->file_path) )
            $this->tpl_code = file_get_contents($this->file_path);
        else
            throw new TemEx();
    }

    public function Render($params = null){
        $this->ready_tpl = $this->tpl_code;
        if($this->tpl_code){
            //var_dump($params); Параметры приходят
            $this->tpl_analyzer = new TplAnalyzer($this->file_path, $params);
            $this->tpl_code = $this->tpl_analyzer->GetPage();
            echo $this->tpl_code;
        }
        else
            throw new TemEx();
    }
} 