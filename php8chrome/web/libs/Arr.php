<?php
class Arr
{

    /**
     * 将二维数组数组按某个键提取出来组成新的索引数组
     * @param array $array
     * @param string $key
     * @return array
     */
    public static function extract($array = [], $key = 'id'): array
    {
        $count = count($array);

        $new_arr = [];

        for ($i = 0; $i < $count; $i++) {
            if (!empty($array) && !empty($array[$i][$key])) {
                $new_arr[] = $array[$i][$key];
            }
        }

        return $new_arr;
    }

    /**
     * 生成数据签名
     * @param string $secret
     * @param array $data
     * @param string|array $keys
     * @return string
     */
    public static function genSign( $secret, $data, $keys = [])
    {

        $keys = static::exp($keys);
        if(!$keys){
            $keys=array_keys($data);
        }

        $strs = [];
        if ($keys) {

            foreach ($keys as $key) {
                $val = '';
                if (array_key_exists($key, $data)) {
                    $val = $data[$key] ?: '';
                }
                if (is_null($val)) {
                    $val = '';
                }
                if (!(is_string($val) || is_numeric($val))) {
                    $val= json_encode($val,JSON_OBJECT_AS_ARRAY);
                }
                $strs[]=sprintf("%s=%s",$key,$val);
            }
        }
        array_multisort($strs);
        $data_str=implode('&',$strs);
        $render = sha1(sprintf("%s%s%s",$secret,$data_str,$secret));
        return $render;
    }

    /**
     * 获取path 的获取变量的值
     * 主要解决 php7.4 Trying to access array offset on value of type null的问题.
     * @param array|string|number|object $detail
     * @param string $path 
     * @param array|string|number|object $default_value
     * @return array|string|number|object
     */
    public static function varPath(&$detail, string $path, $default_value = null)
    {
        $render = self::_varPath($detail, $path);
        if (is_null($render)) {
            $render = $default_value;
        }
        return $render;
    }

    protected static function _varPath(&$detail, string $path, bool $first = true)
    {

        $paths = explode('.', $path);

        if (count($paths) == 0) {
            if ($first) {
                return;
            }
        }
        $top_path = array_shift($paths);
        $render   = null;


        if (is_object($detail)) {
            if (isset($detail->$top_path)) {
                if (count($paths) > 0) {
                    $path    = implode('.', $paths);
                    $_detail = $detail->$top_path;
                    $render  = self::_varPath($_detail, $path, false);
                } else {
                    $render = $detail->$top_path;
                }
            }
        } else {
            if (isset($detail[$top_path])) {
                if (count($paths) > 0) {
                    if (is_array($detail[$top_path])||is_object($detail[$top_path])) {
                        $path   = implode('.', $paths);
                        $render = self::_varPath($detail[$top_path], $path, false);
                    }
                } else {
                    $render = $detail[$top_path];
                }
            }
        }
        return $render;
    }
    /**
     * 分割变量,转为数组
     * @param mixed $string
     * @param string $separator
     * @param bool $trimFlag
     * @return array
     */
    public static function exp($string, $separator = ',', $trimFlag = true)
    {
        $render = [];
        if (is_string($string)) {
            $render = explode($separator, $string);
        } elseif (is_numeric($string)) {
            $render = [$string];
        } elseif (is_array($string)) {
            $render = $string;
        }

        if (!is_array($render)) {
            $render = [];
        }
        if ($trimFlag) {
            $_tmp = [];
            foreach ($render as $row) {
                if(is_string($row)){
                    $row = trim($row);
                }
                
                if ($row) {
                    $_tmp[] = $row;
                }
            }
            $render = $_tmp;
        }
        return $render;
    }
    /**
     * 合并成为字符串
     * @param mixed $values
     * @param string $separator
     * @param bool $trimFlag
     * @return string
     */
    public static function imp($values, $separator=',',$trimFlag=true){
        $arr = static::exp($values,$separator,$trimFlag);
        return implode($separator,$arr);
    }

    /**
     * 批量根据路径修改数组的值
     * @param array $detail
     * @param array $defaultConfig
     * @return mixed
     */
    public static function batchSetPath(array $detail, array $defaultConfig)
    {
        foreach ($defaultConfig as $path => $defaultValue) {
            $detail = self::setPath($detail, $path, $defaultValue);
        }
        return $detail;
    }
    /**
     * 根据路径修改数组的值
     * @param array $detail
     * @param string $path
     * @param mixed $defaultValue
     * @return array
     */
    public static function setPath($detail, $path, $defaultValue = null)
    {
        self::_setPath($detail, $path, $defaultValue);
        return $detail;
    }

    protected static function _setPath(&$detail, $path, $defaultValue = null, $isFirst = true)
    {
        $paths = explode('.', $path);
        if (count($paths) == 0) {
            return;
        }
        $top_path = array_shift($paths);
        $subPath  = implode('.', $paths);

        if ($top_path == '*') {
            foreach ($detail as &$val) {
                if ($subPath) {
                    self::_setPath($val, $subPath, $defaultValue, false);
                } else {
                    $val = $defaultValue;
                }
            }
        } else {
            if ($subPath) {
                if (!isset($detail[$top_path])) {
                    $detail[$top_path]=[];
                }
                self::_setPath($detail[$top_path], $subPath, $defaultValue, false);
            } else {
                $detail[$top_path] = $defaultValue;
            }
        }
    }
}