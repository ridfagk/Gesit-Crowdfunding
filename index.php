<?php

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');
require('_gesit/vendor/autoload.php');
require('_gesit/vendor/yiisoft/yii2/Yii.php');
require('_gesit/common/config/bootstrap.php');
require('_gesit/frontend/config/bootstrap.php');
$config = yii\helpers\ArrayHelper::merge(
    require('_gesit/common/config/main.php'),
    require('_gesit/common/config/main-local.php'),
    require('_gesit/frontend/config/main.php'),
    require('_gesit/frontend/config/main-local.php')
);
$application = new yii\web\Application($config);
$application->run();
