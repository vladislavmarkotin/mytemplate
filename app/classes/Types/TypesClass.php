<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 05.04.2018
 * Time: 9:58
 */

namespace Types;


class TypesClass {

    private $types = [
        "integer",
        "double",
        "string",

    ];

    public function getTypes(){
        return $this->types;
    }

} 