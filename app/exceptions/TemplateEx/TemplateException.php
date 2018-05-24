<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 27.03.2018
 * Time: 8:35
 */

namespace TemplateEx;


class TemplateException {

    public function __construct($message = null){
        if ($message){
            die( $message );
        }
        die( "Error with template file!" );
    }
} 