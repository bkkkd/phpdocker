<?php
class TaskLogic {
    public function getTaskDirPath(){
        return root_path('data/task');
    }
    public function getPdfDirPath(){
        
        return root_path('data/pdf');
    }
    public function clearPdf(){
        $timestamp = time();
        FileUtil::eachFile($this->getPdfDirPath(),function($filepath)use($timestamp){
            $createTime = filectime($filepath);
            $diff = $createTime-$timestamp;
            if($diff<3600){
                return;
            }
            FileUtil::unlinkFile($filepath); 
        });
    }
    public function getKey($clientid,$taskid){
        return md5(sprintf('%s@%s',$clientid,$taskid));
    }
    public function getTaskPath($clientid,$taskid){
        return $this->getTaskDirPath().'/'.$this->getKey($clientid,$taskid).'.json';
    }
    public function getTaskPathByKey($key){

        if(!checkMd5($key)){
            throw new \Exception('key错误');
        }
        return $this->getTaskDirPath().'/'.$key.'.json';
    }
    public function getPdfPath($clientid,$taskid){
        return $this->getPdfDirPath().'/'.$this->getKey($clientid,$taskid).'.pdf';
    }
    public function existTask($clientid,$taskid){
        
        $filepath = $this->getTaskPath($clientid,$taskid);
        $render = false;
        if(is_file($filepath)){
            $render = true;
        }
        return $render;
    }
    public function getInfo($clientid,$taskid){
        if(!$this->existTask($clientid,$taskid)){
            throw new \Exception('任务不存在');
        }

        $filepath = $this->getTaskPath($clientid,$taskid);
        $filecontent = file_get_contents($filepath);
        if(!$filecontent){
            throw new \Exception('任务数据异常');
        }
        $data = @json_decode($filecontent,JSON_OBJECT_AS_ARRAY);
        if(!$data){
            throw new \Exception('任务数据异常.');
        }
        return $data;

    }
    public function getInfoByKey($key){

        $filepath = $this->getTaskPathByKey($key);
        if(!file_exists($filepath)){

            throw new \Exception('任务数据异常!');
        }
        $filecontent = file_get_contents($filepath);
        if(!$filecontent){
            throw new \Exception('任务数据异常');
        }
        $data = @json_decode($filecontent,JSON_OBJECT_AS_ARRAY);
        if(!$data){
            throw new \Exception('任务数据异常.');
        }
        return $data;

    }
    public function saveInfo($clientid,$taskid,$data){


        $filepath = $this->getTaskPath($clientid,$taskid);
        $dataString = json_encode($data);
        FileUtil::createDir($this->getTaskDirPath());
        file_put_contents($filepath,$dataString);
    }
    public function removeInfo($clientid,$taskid){
        
        if($this->existTask($clientid,$taskid)){
            FileUtil::unlinkFile($this->getTaskPath($clientid,$taskid));
            FileUtil::unlinkFile($this->getPdfPath($clientid,$taskid));
        }
        return true;
    }
    public function savePdfFile($clientid,$taskid,$filecontent){
        $key=  $this->getKey($clientid,$taskid);
        $taskInfo =$this->getInfo($clientid,$taskid);
        FileUtil::createDir($this->getPdfDirPath());
        $pdfpath =$this->getPdfPath($clientid,$taskid);
        file_put_contents($pdfpath,$filecontent);
        $taskInfo['status']='FINISH';
        $taskInfo['pdfpath']=$pdfpath;
        $this->saveInfo($clientid,$taskid,$taskInfo);
    }
    public function isFinish($clientid,$taskid){
        $taskInfo = $this->getInfo($clientid,$taskid);
        $status = Arr::varPath($taskInfo,'status');
        $render = false;
        if($status=='FINISH' && file_exists($this->getPdfPath($clientid,$taskid))){
            $render = true;
        }
        return $render;

    }
    public function getTaskList(){
        $render = [];
        $timestamp = time();
        FileUtil::eachFile($this->getTaskDirPath(),function($filepath)use(&$render,$timestamp){

            $createTime = filectime($filepath);
            $diff = $createTime-$timestamp;

            if($diff>3600){
                FileUtil::unlinkFile($filepath);
                return;
            }
            
            $filecontent = file_get_contents($filepath);
            if(!$filecontent){
                throw new \Exception('任务数据异常');
            }
            $data = @json_decode($filecontent,JSON_OBJECT_AS_ARRAY);
            if(!$data){
                throw new \Exception('任务数据异常.');
            }
            $clientid=Arr::varPath($data,'clientid');
            $taskid=Arr::varPath($data,'taskid');
            $status=Arr::varPath($data,'status');
            if($status!='INIT'){
                return;
            }
            $row=[
                'key'=>$this->getKey($clientid,$taskid),
                'taskdata'=>Arr::varPath($data,'taskdata'),
            ];
            $data['status']='RUNNING';
            $this->saveInfo($clientid,$taskid,$data);
            $render[]=$row;
        });
        return $render;
    }
}