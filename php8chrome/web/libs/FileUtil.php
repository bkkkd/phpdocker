<?php

class FileUtil
{

    /**
     * @param string $url 文件夹路径
     * @return bool
     */
    public static function createDir(string $url): bool
    {
        $url    = str_replace('', '/', $url);
        $dir    = '';
        $urlArr = explode('/', $url);
        $result = true;
        foreach ($urlArr as $value) {
            $dir .= $value . '/';
            if (!file_exists($dir)) {
                $result = mkdir($dir);
            }
        }

        return $result;
    }

    /**
     * 移动目录
     * @param string $oldDir 移动文件夹
     * @param string $aimDir 目标文件夹
     * @param bool $overwrite 是否覆盖
     * @return bool
     */
    public static function moveDir(string $oldDir, string $aimDir, $overwrite = false): bool
    {
        $aimDir = str_replace('', '/', $aimDir);
        $aimDir = substr($aimDir, -1) == '/' ? $aimDir : $aimDir . '/';
        $oldDir = str_replace('', '/', $oldDir);
        $oldDir = substr($oldDir, -1) == '/' ? $oldDir : $oldDir . '/';
        if (!is_dir($oldDir)) {
            return false;
        }

        if (!file_exists($aimDir)) {
            self::createDir($aimDir);
        }

        @$handle = opendir($oldDir);
        if (!$handle) {
            return false;
        }

        while (false !== ($file = readdir($handle))) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            if (!is_dir($oldDir . $file)) {
                self::moveFile($oldDir . $file, $aimDir . $file, $overwrite);
            } else {
                self::moveDir($oldDir . $file, $aimDir . $file, $overwrite);
            }
        }

        closedir($handle);
        return rmdir($oldDir);
    }

    /**
     * 新建文件
     * @param string $url 文件路径
     * @param bool $overwrite 是否覆盖
     * @return bool
     */
    public static function createFile(string $url, $overwrite = false): bool
    {
        if (file_exists($url)) {
            if ($overwrite) {
                self::unlinkFile($url);
            } else {
                return false;
            }
        }

        $dir = dirname($url);
        self::createDir($dir);
        touch($url);
        return true;
    }

    /**
     * 移动文件
     * @param string $fileUrl 原文件路径
     * @param string $aimUrl 目标文件路径
     * @param bool $overwrite 是否覆盖
     * @return bool
     */
    public static function moveFile(string $fileUrl, string $aimUrl, $overwrite = false): bool
    {
        if (!file_exists($fileUrl)) {
            return false;
        }

        if (file_exists($aimUrl)) {
            if ($overwrite) {
                self::unlinkFile($aimUrl);
            } else {
                return false;
            }
        }

        $aimDir = dirname($aimUrl);
        self::createDir($aimDir);
        rename($fileUrl, $aimUrl);
        return true;
    }

    /**
     * 删除文件夹
     * @param string $dir
     * @return bool
     */
    public static function unlinkDir(string $dir): bool
    {
        $dir = str_replace('', '/', $dir);
        $dir = substr($dir, -1) == '/' ? $dir : $dir . '/';
        if (!is_dir($dir)) {
            return false;
        }

        $handle = opendir($dir);
        while (false !== ($file   = readdir($handle))) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            if (!is_dir($dir . $file)) {
                self::unlinkFile($dir . $file);
            } else {
                self::unlinkDir($dir . $file);
            }
        }

        closedir($handle);
        return rmdir($dir);
    }

    /**
     * 删除文件
     * @param string $url 文件路径
     * @return bool
     */
    public static function unlinkFile(string $url): bool
    {
        if (file_exists($url)) {
            unlink($url);
            return true;
        }

        return false;
    }

    /**
     * 复制文件夹
     * @param string $oldDir 源文件夹
     * @param string $aimDir 目标文件夹
     * @param bool $overwrite 是否覆盖
     * @return bool
     */
    public static function copyDir(string $oldDir, string $aimDir, $overwrite = false): bool
    {
        $aimDir = str_replace('', '/', $aimDir);
        $aimDir = substr($aimDir, -1) == '/' ? $aimDir : $aimDir . '/';
        $oldDir = str_replace('', '/', $oldDir);
        $oldDir = substr($oldDir, -1) == '/' ? $oldDir : $oldDir . '/';
        if (!is_dir($oldDir)) {
            return false;
        }

        if (!file_exists($aimDir)) {
            self::createDir($aimDir);
        }

        $handle = opendir($oldDir);
        while (false !== ($file   = readdir($handle))) {
            if ($file == '.' || $file == '..') {
                continue;
            }

            if (!is_dir($oldDir . $file)) {
                self::copyFile($oldDir . $file, $aimDir . $file, $overwrite);
            } else {
                self::copyDir($oldDir . $file, $aimDir . $file, $overwrite);
            }
        }

        closedir($handle);
        return true;
    }

    /**
     * 复制文件
     * @param string $fileUrl 源文件路径
     * @param string $aimUrl 目标文件路径
     * @param bool $overwrite 是否覆盖
     * @return bool
     */
    public static function copyFile(string $fileUrl, string $aimUrl, $overwrite = false): bool
    {
        if (!file_exists($fileUrl)) {
            return false;
        }

        if (file_exists($aimUrl)) {
            if ($overwrite) {
                self::unlinkFile($aimUrl);
            } else {
                return false;
            }
        }

        $aimDir = dirname($aimUrl);
        self::createDir($aimDir);
        copy($fileUrl, $aimUrl);
        return true;
    }

    /**
     * 判断文件夹是否为空
     * @param string $dir 文件夹
     * @return bool
     */
    public static function isEmptyDir(string $dir): bool
    {
        if (!is_dir($dir)) {
            return true;
        }

        $res = array_diff(scandir($dir), ['..', '.']);
        return empty($res);
    }

    /**
     * 生产一个临时文件,返临时文件的路径
     * @param string $prefix
     * @return string
     * @throws \Exception
     */
    public static function tmpfile($prefix = '')
    {
        $times   = 6;
        $dirpath = rtrim(root_path('runtime/tmpfile/' . $prefix), '/,' . DIRECTORY_SEPARATOR);
        if (!is_dir($dirpath)) {
            self::createDir($dirpath);
        }
        do {

            $filepath = $dirpath . '/' . random(8) . '.tmp';

            $times--;
            if (!file_exists($filepath)) {
                break;
            }
            if ($times <= 0) {
                throw new \Exception('创建临时文件失败' . $filepath);
            }
        } while (true);
        self::createFile($filepath);
        self::cleanTmp();
        return $filepath;
    }
    public static function cleanTmp($overtime=86400,$perfix=''){
        $perfix=str_replace('..','',$perfix);
        $dirpath = rtrim(root_path('runtime/tmpfile/'.$perfix ), '/,' . DIRECTORY_SEPARATOR);
        if (!is_dir($dirpath)) {
            self::createDir($dirpath);
        }
        $handle = opendir($dirpath);
        $lastModifyTime = time()-$overtime;
        while (false !== ($file   = readdir($handle))) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $filepath = $dirpath.DIRECTORY_SEPARATOR.$file;

            if (is_dir($filepath)) {
                self::cleanTmp($overtime,$perfix.DIRECTORY_SEPARATOR.$file);
            } elseif(is_file($filepath) && filemtime($filepath)<$lastModifyTime){
                self::unlinkFile($filepath);
            }
        }
    }

    public static function tmpfileHandle($content = '')
    {
        $render = tmpfile();
        if ($content) {
            @fwrite($render, $content);
            fseek($render, SEEK_SET, 0);
        }
        return $render;
    }
    public static function eachFile($dirpath,\Closure $callback){
        $dirpath = str_replace('..','',$dirpath );
        if (!is_dir($dirpath)) {
            return;
        }
        $handle = opendir($dirpath);
        while (false !== ($file   = readdir($handle))) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            $filepath = $dirpath.DIRECTORY_SEPARATOR.$file;

            if (is_dir($filepath)) {
                self::eachFile($filepath,$callback);
            } elseif($callback && $callback instanceof \Closure){
                $callback($filepath);
            }
        }
        closedir($handle);
    }
}
