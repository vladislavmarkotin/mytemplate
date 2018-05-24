<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 19.03.2018
 * Time: 7:55
 */
require_once 'vendor/autoload.php';

spl_autoload_register(function ($class){
    if (strpos($class, "Ex")){
        $class = "app/exceptions/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
    else {
        $class = "app/classes/".str_replace('\\', '/', $class) . '.php';
        require_once($class);
    }
});

use Tpl\Tpl as Tpl;
use TemplateEx\TemplateException;

$test = false;

$params = [
    "_vlad" => "Billionaire",
    "_num" => 1234567,
    "_test" => 12.2575,
    "include_path" => 'app/tpl/foreach.tpl',
    "include_path2" => 'app/tpl/test2.tpl'
];

$tpl = Tpl::getInstance("app/tpl/test.tpl");
$tpl->init();
$tpl->Render($params);