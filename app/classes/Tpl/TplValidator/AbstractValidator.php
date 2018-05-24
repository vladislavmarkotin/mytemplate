<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 28.03.2018
 * Time: 7:39
 */

namespace Tpl\TplValidator;


abstract class AbstractValidator {
    /*protected $validators = [];

    abstract protected  function Check();*/

    protected $name;

    abstract protected function Check($template, array $params = null);

    // Constructor
    public function __construct($name)
    {
        $this->name = $name;
    }

    /*public abstract function add(AbstractValidator $c);
    public abstract function remove(AbstractValidator $c);
    public abstract function display();*/
} 