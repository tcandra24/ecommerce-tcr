<?php

if (! function_exists('initialName')) {
    /**
     * moneyFormat
     *
     * @param  mixed $str
     * @return void
     */
    function initialName($value) {
        $extract = explode(' ', $value);
        $result = '';
        if(count($extract) > 1){
            $result = substr($extract[0], 0, 1) . substr($extract[1], 0, 1);
        } else {
            $result = substr($extract[0], 0, 2);
        }
        return strtoupper($result);
    }
}
