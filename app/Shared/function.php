<?php
function checkKey($table,$id, $item){
    foreach ($table as $value){
        if ($value[$id] == $item){
            return true;
        }else{
            return false;
        }
    }
    return false;
}