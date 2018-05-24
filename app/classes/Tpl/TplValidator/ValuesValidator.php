<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 28.03.2018
 * Time: 8:19
 */

namespace Tpl\TplValidator;

spl_autoload_register(function ($class){
    if (strpos($class, "Ex")){
        $class = "app/exceptions/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
    elseif (strpos($class, "Types")){
        $class = "app/classes/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
    else {
        $class = "app/classes/TplValidator/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
});

use TemplateEx\TemplateException as TemEx;
use Types\TypesClass;
use TemplateEx\TypeEx as TypeEx;

class ValuesValidator extends AbstractValidator{

    private $params = null;

    protected function Check($template, array $params = null){
        if($this->params){
            $typesobj = new TypesClass();
            $types = $typesobj->getTypes();

            $params_length = count( $this->params);
            $right_types = 0;
            foreach ($this->params as $p){
                foreach ($types as $t){
                    if (gettype($p) == $t){
                        $right_types++;
                    }
                }
            }

            if ($params_length == $right_types){
                return 1;
            }
            else throw new TypeEx();

        }
        else throw new TypeEx();

    }

    public function __construct($params = null){
        if ($params){
            $this->params = $params;
        }
    }

    public function add(AbstractValidator $c)
    {
        print ("Cannot add to a leaf");
    }

    public function remove(AbstractValidator $c)
    {
        print("Cannot remove from a leaf");
    }

    public function display()
    {
        print_r($this->name);
    }

} 