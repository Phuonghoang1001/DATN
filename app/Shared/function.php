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
function muti_level($data, $parent_id=0 , $level=0)
{
    $result = array();
    foreach ($data as $item) {
        if ($item['parent_id'] == $parent_id) {
            $item['level'] = $level;
            $result[] = $item;
            $child = muti_level($data, $item['id'], $level + 1);
            $result = array_merge($result, $child);
        }
    }
    return $result;
}