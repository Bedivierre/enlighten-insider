<?php


namespace Bedivierre\Enlighten\Insider\Core;

class EnlightenUtility
{
    static function array_path(&$array, string $path, string $limiter = '.')
    {
        if (!(is_array($array)))
            return null;
        $p = explode($limiter, $path);
        if (!$p)
            return $array;
        $var = $array;
        foreach ($p as $_p) {
            if(!(is_array($var)))
                return null;
            //только массив доходят сюда
            if((is_array($var))) {
                if (!isset($var[$_p]))
                    return null;
                $var = $var[$_p];
            }
        }
        return $var;
    }
    static function array_add($array, string $path, $value, $overwrite = true, string $limiter = '.')
    {
        $path = trim($path);
        $pathArray = explode($limiter, $path);
        $val = null;
        $count = count($pathArray);

        if($count < 1 || !$path)
            return $array;

        if($count == 1 && $path){
            if(!isset($array[$path]) || $overwrite) {
                $array[$path] = $value;
            }
            return $array;
        }

        if(isset($array[$pathArray[0]])){
            if(!$overwrite)
                return $array;
            $arr = $array[$pathArray[0]];
            if(!is_array($arr))
                $arr = [];
        } else {
            $arr = [];
        }
        $array[$pathArray[0]] = self::array_add(
            $arr,
            join($limiter, array_splice($pathArray, 1)),
            $value,
            $overwrite,
            $limiter
        );

        return $array;
    }
}