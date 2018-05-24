<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 28.03.2018
 * Time: 7:25
 */

namespace Tpl\TplValidator;

use Options\TplOptions as Options;
use TemplateEx\TemplateException as TemEx;

spl_autoload_register(function ($class){
    if (strpos($class, "Ex")){
        $class = "app/exceptions/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
    elseif(strpos($class, "Options")){
        $class = "app/classes/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
    else {
        $class = "app/classes/TplValidator/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
});



class SyntaxValidator extends Validator{

    private $special_chars;

    private function CompareAnswers($first_srr,$second_arr){

        if (count($first_srr) == count($second_arr)){
            for ($i = 0; $i < count($first_srr); $i++)
                if ($first_srr[$i] != $second_arr[$i])
                    return 0;
            return 1;
        }
        return 0;
  }

    private function FindElement($template, $needle){

        return substr_count($template, $needle);
    }

    public function Check($template, array $params = null)
    {
        $options = new Options();
        $this->special_chars = $options->GetOptions();
        $open_options = [];
        $close_options = [];
        //print_r($special_chars);

        foreach ($this->special_chars as $index => $specs) {
            if ($index == "start_options") {
                foreach ($specs as $s) {
                    array_push($open_options, $this->FindElement($template, $s));
                    //print_r($open_options);
                }
            } else {
                foreach ($specs as $s) {
                    array_push($close_options, $this->FindElement($template, $s));
                }
            }


        }

        //print_r($open_options);
        //print_r($close_options);

        if ($this->CompareAnswers($open_options, $close_options))
            return 1;

        return 0;
    }


} 