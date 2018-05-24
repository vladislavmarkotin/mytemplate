<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 26.03.2018
 * Time: 7:53
 */

namespace Tpl;

spl_autoload_register(function ($class){
    if (strpos($class, "Ex")){
        $class = "app/exceptions/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
    elseif(strpos($class, "Op")){
        $class = "app/classes/".str_replace('\\', '/', $class) . '.php';
    }
    elseif(strpos($class, "Sanitaise")){
        $class = "app/classes/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
    elseif(strpos($class, "Validator")){
        $class = "app/classes/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
    elseif(strpos($class, "Decorate")){
        $class = "app/classes/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
    else {
        $class = "app/classes/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
});

use TemplateEx\TemplateException as TemEx;
use Tpl\TplValidator\SyntaxValidator;
use Tpl\TplValidator\Validator as Validator;
use Options;
use Tpl\TplValidator\ValuesValidator;
use Tpl\TplDecorate as Decorate;
use Tpl\TplSanitaise\SanitaiseClass as Sanitaise;

class TplAnalyzer {

    private $path_to_analyze = null;
    private $tmp_code = null;
    private $validator = null;
    private $final_template = null;
    private $decorator = null;
    private $sanitaise = null;

    private function getLinkedAdress(){


    }

    private function ParseArrays(array $params, $index = null){
        if ($params){

            //var_dump($params);
            //echo $index;

            $str = "";
            $file = $this->getLinkedAdress();
            $this->decorator = new Decorate($file);

            foreach($params as $k => $v){
                if( !is_array($v) ){
                    $str .= $v." ";
                    $this->decorator->Decorate();

                }
                else{
                    //var_dump($v);
                    $this->tmp_code = $this->ParseArrays($v);
                }

            }

            $this->tmp_code = str_replace($index, $str, $this->tmp_code);
            return $this->tmp_code;
        }
        throw new TemEx("Error with parsing an array");
    }

    private function InsertBlock($file){
        try{
            $block = file_get_contents($file);
        }catch (TemEx $e){
            die("Its a bullshit");
        }
        return $block;
    }

    private function Sanitaize(){

        $this->sanitaise = new Sanitaise();

        $this->tmp_code = $this->sanitaise->SanitaiseVar($this->tmp_code);
        $this->tmp_code = $this->sanitaise->SanitaiseForeach($this->tmp_code);

    }

    private function InsertValues(array $params){
        foreach ($params as $key => $value){
            if (!is_array($value)){
                if(strpos($key, "include_") === 0){
                    $block = $this->InsertBlock($value);
                    $this->tmp_code = str_replace($key,$block, $this->tmp_code);
                    $this->Sanitaize();
                    unset($params[$key]);
                    $this->InsertValues($params);
                }
                else{
                    $this->tmp_code = str_replace($key,$value, $this->tmp_code);
                }
            }
            else{
                //$this->tmp_code = $this->ParseArrays($value, $key);

            }
        }
    }

    private function Analyze($path, $params = null){
        $this->tmp_code = file_get_contents($path);

        $this->validator = new Validator("");
        $this->validator->add(new SyntaxValidator("Syntax"));
        $this->validator->add(new ValuesValidator($params));
        $this->validator->Check($this->tmp_code);


        $this->Sanitaize();
        $this->InsertValues($params);
        //echo $this->InsertBlocks($address);

        return $this->tmp_code;
    }

    public function __construct($file_path, $params = null){
        if ($file_path){
            //var_dump($params); //параметры шаблона
            $this->path_to_analyze = $file_path;
            $this->final_template = $this->Analyze($this->path_to_analyze, $params);
        }
        else throw new TemEx();
    }

    public function GetPage(){
        if ($this->final_template){
            return $this->final_template;
        }
        return 0;
    }
} 