<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 28.03.2018
 * Time: 8:03
 */

namespace Tpl\TplValidator;

spl_autoload_register(function ($class){
    if (strpos($class, "Ex")){
        $class = "app/exceptions/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
    else {
        $class = "app/classes/TplValidator/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
});

use TemplateEx\TemplateException as TemEx;


class Validator extends AbstractValidator{

    private $children = array();

    public function Check($template, array $params = null){
        $checks = [];
        if ($this->children){
            foreach ($this->children as $child){
                array_push( $checks, $child->Check($template) );
            }

            //var_dump($checks);

            foreach ($checks as $c)
            {
                if(!$c)
                    throw new TemEx();
            }
            return 1;
        }
        throw new TemEx();
    }

    public function getValidator($index = 0){
        return $this->children[$index];
    }

    public function add(AbstractValidator $component)
    {
        array_push($this->children, $component);
    }

    public function remove(AbstractValidator $component)
    {
        unset($this->children[$component->name]);
    }

    public function display()
    {
        foreach($this->children as $child)
            $child->display();
    }
} 