<?php
/**
 * Created by PhpStorm.
 * User: Vlad
 * Date: 16.04.2018
 * Time: 7:24
 */

namespace Tpl\TplSanitaise;


class SanitaiseClass {

    private function DeepSanitaiseOfInclude($code){
        $end = strpos($code, "</");
        $code = substr($code, 0, $end);
        return $code;
    }

    public function SanitaiseVar($code){
        $code = str_replace("{{","", $code );
        $code = str_replace("}}","", $code );

        return $code;
    }

    public function SanitaiseInclude($code, $index){

    }

    public function SanitaiseForeach($code){

        $code = str_replace("{% startforeach", "", $code);
        $code = str_replace("endforeach %}", "", $code);

        return $code;
    }
} 