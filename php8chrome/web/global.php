<?php
define('APP_PATH',dirname(__FILE__));
define('APP_DEBUG',getenv('APP_DEBUG')?true:false);
define('STATIC_VERSION',time());
define('DEFAULT_DATA_KEY',getenv('DEFAULT_DATA_KEY')?:'111111');
define('SIGN_EFF_SEC',getenv('SIGN_EFF_SEC')?:(APP_DEBUG?3600:30));


include APP_PATH.'/libs/func.php';
include APP_PATH.'/libs/Arr.php';
include APP_PATH.'/libs/FileUtil.php';
include APP_PATH.'/libs/TaskLogic.php';