<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 26.03.2018
 * Time: 8:00
 */
namespace Options;

class TplOptions{

    private $options = [
        "start_options" => [
            "{{",
            "{% ",
            "startforeach",
            "@include('"
        ],
        "end_options" => [
            "}}",
            "%}",
            "endforeach",
            "')@endinclude"
        ]
    ];

    public function __construct(){}

    public function GetOptions(){
        return $this->options;
    }
}
