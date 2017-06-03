<?php

namespace app\modules\account;

use Yii;
use yii\base\Module as yiiModule;

class Module extends yiiModule
{
    public $controllerNamespace = 'app\modules\account\controllers';

    public $defaultRoute = 'user';

    public function init()
    {
        parent::init();

        // custom initialization code goes here

    }
}
