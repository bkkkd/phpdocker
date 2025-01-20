<?php
include '../global.php';
if(!APP_DEBUG && !checkRequestInter()){
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>打印生成pdf任务器</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <link href="/static/hiprint/css/hinnn.css?v=<?php echo STATIC_VERSION?>" rel="stylesheet" />
        <link href="/static/hiprint/css/hiprint.css?v=<?php echo STATIC_VERSION?>" rel="stylesheet" />
        <link href="/static/hiprint/css/print-lock.css?v=<?php echo STATIC_VERSION?>" rel="stylesheet" />
        <link href="/static/hiprint/bootstrap/css/bootstrap.min.css?v=<?php echo STATIC_VERSION?>" rel="stylesheet">
        <script src="/static/hiprint/jquery.1.12.4.min.js?v=<?php echo STATIC_VERSION?>"></script>
        <script src="/static/common.js?v=<?php echo STATIC_VERSION?>"></script>
</head>

<body>
    
    <script src="/static/hiprint/custom_test/edit-etype-provider.js?v=<?php echo STATIC_VERSION?>"></script>
    <!--单独使用无需引入  -->
    <script src="/static/hiprint/polyfill.min.js?v=<?php echo STATIC_VERSION?>"></script>
    <script src="/static/hiprint/plugins/jquery.minicolors.min.js?v=<?php echo STATIC_VERSION?>"></script>
    <script src="/static/hiprint/plugins/JsBarcode.all.min.js?v=<?php echo STATIC_VERSION?>"></script>
    <script src="/static/hiprint/plugins/qrcode.js?v=<?php echo STATIC_VERSION?>"></script>
    <script src="/static/hiprint/hiprint.bundle.js?v=<?php echo STATIC_VERSION?>"></script>
    <script src="/static/hiprint/plugins/jquery.hiwprint.js?v=<?php echo STATIC_VERSION?>"></script>
    <script src="/static/hiprint/plugins/jspdf/jspdf.min.js?v=<?php echo STATIC_VERSION?>"></script>
    <script src="/static/hiprint/plugins/jspdf/html2canvas.min.js?v=<?php echo STATIC_VERSION?>"></script>
    <script src="/static/hiprint/plugins/jspdf/canvg.min.js?v=<?php echo STATIC_VERSION?>"></script>
    <script src="/static/hiprint/plugins/jspdf/canvas2image.js?v=<?php echo STATIC_VERSION?>"></script>
    <script src="/static/hiprint/bootstrap/js/bootstrap.min.js?v=<?php echo STATIC_VERSION?>"></script>

    <script type="text/javascript">
            $(function () {
            
                // 可以获取任务的状态
                let canGetTask = true;
                // 可以运行任务状态
                let canRunTask = true;
                let taskList=[];
                // 获取任务的定时器
                setInterval(function () {
                    if (!canGetTask) {
                        console.log('运行任务中不能获取任务');
                        return;
                    }
                    getAjax('taskList.php',{},function(res){
                        let infoList = varPath(res,'results');
                        
                        if(!$.isArray(infoList)){
                            return;
                        }
                        $.each(infoList,function(i,task){

                            console.log('获取到任务',task);
                            taskList.push(task);
                        });
                    },function(res){
                        console.log('获取任务错误:',res);
                    })
                }, 1000);
                let runnerTask=function(task){

                    let templateData = $.extend({},varPath(task,'taskdata.template'));
                    let printData = varPath(task,'taskdata.data',{});
                    let key = varPath(task,'key','');
                    let pdfFilename = varPath(printData,'__pfd_file_name',""+(new Date).getTime());

                    //初始化打印插件
                    hiprint.init({
                        providers:[new EditElementTypeProvider()]
                    });

                    let hiprintTemplate = new hiprint.PrintTemplate({
                        template:templateData
                    });
                    let html = hiprintTemplate.toOutput(printData,function(s){
                        let formData = new FormData();
                        formData.append("file", s.output('blob'), "example.pdf");
                        formData.append("key",key );
                        postUploadAjax('finishtask.php',formData,function(res){

                            canRunTask=true;
                        },function(res){

                            canRunTask=true;
                        },false,false)
                    });
                    
                    
                }
                // 执行任务的定时器
                setInterval(function () {
                    if(taskList.length<=0){
                        canGetTask=true;
                        return;
                    }
                    if(!canRunTask){
                        console.log('不能启用新任务');
                        return;
                    }
                    canGetTask=false;
                    canRunTask=false;
                    let task = taskList.shift();
                    try{
                        console.log('开始运行任务',task)
                        runnerTask(task)
                        console.log('结束运行任务',task)
                    }catch(e){
                        debugger
                        taskList.push(task);
                        console.log('runnerTask ERROR',e);
                        canRunTask=true;
                    }
                    

                    console.log('任务',task);
                    console.log('未执行任务数:'+taskList.length)
                }, 500);
            })
        </script>
</body>

</html>