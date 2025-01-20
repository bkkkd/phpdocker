<?php

include '../global.php';
if(!APP_DEBUG && !checkRequestInter()){
    exit;
}
$file = Arr::varPath($_FILES,'file');
$key = Arr::varPath($_REQUEST,'key');
$tmpname= Arr::varPath($file,'tmp_name');
if(!$tmpname || !file_exists($tmpname) || !$key){
    error_json('数据异常');
}
$taskLogic = new TaskLogic();
$taskInfo = $taskLogic->getInfoByKey($key);
$clientid = Arr::varPath($taskInfo,'clientid');
$taskid = Arr::varPath($taskInfo,'taskid');
if(!$clientid || !$taskid){
    error_json(message: '任务数据无法定位');
}
$taskLogic->savePdfFile($clientid,$taskid,file_get_contents($tmpname));
success_json('上传成功');