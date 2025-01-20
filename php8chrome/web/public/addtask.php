<?php
include '../global.php';

$timestamp=Arr::varPath($_REQUEST,'timestamp');
$dataBase64 = Arr::varPath($_REQUEST,'data');
$sign = Arr::varPath($_REQUEST,'sign');
$genSign = data_md5_key(['timestamp'=>$timestamp,'data'=>$dataBase64]);

$diff=time()-$timestamp;
$between=SIGN_EFF_SEC;
if($diff>$between || $diff<-$between){
    error_json('超时'(APP_DEBUG?':'.time():''));
}
if($sign!=$genSign){
    error_json('签名错误'.(APP_DEBUG?':'.$genSign:''));
}

$data = json_decode(base64_decode($dataBase64),JSON_OBJECT_AS_ARRAY);
$clientid = Arr::varPath($data,'clientid');
$taskid = Arr::varPath($data,'taskid');
if(!$clientid || !$taskid){
    error_json('参数错误');
}
$taskLogic = new TaskLogic();
if($taskLogic->existTask($clientid,$taskid)){
    error_json('任务已经存在,请不要重复提交:'.$taskLogic->getKey($clientid,$taskid));
}
$data['status']='INIT';
$data['pdfname']='INIT';

$taskLogic->saveInfo($clientid,$taskid,$data);


$startTime=time();
try{

    do{
        if(time()-$startTime>25){
            throw new \Exception('超时');
        }
        
        sleep(1);
        if(!$taskLogic->isFinish($clientid,$taskid)){
            continue;
        }
        $pdfPath = $taskLogic->getPdfPath($clientid,$taskid);
        $filesize = filesize($pdfPath);
        $fileInfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($fileInfo,$pdfPath);

        $filecontent = file_get_contents($taskLogic->getPdfPath($clientid,$taskid))?:'';
        $taskLogic->removeInfo($clientid,$taskid);
        success_json('成功',['pdf'=>base64_encode($filecontent),'size'=>$filesize,'mimetype'=>$mimeType]);
    }while(true);
}catch(\Exception $e){
    $taskLogic->removeInfo($clientid,$taskid);
    success_json('异常:'.$e->getMessage());
}

