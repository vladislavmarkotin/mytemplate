<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 22.03.2018
 * Time: 8:00
 */

namespace TemplateEx;


class TemplateException extends \Exception{

    public function __construct(){
        die( "Error with template file!" );
    }
} 