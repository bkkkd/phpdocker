<?php
include '../global.php';
if(!APP_DEBUG && !checkRequestInter()){
    exit;
}
$taskLogic = new TaskLogic();
$taskLogic->clearPdf();
$taskList = $taskLogic->getTaskList();
success_json('成功',[],$taskList);
