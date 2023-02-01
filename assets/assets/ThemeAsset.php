<?php
/**
 * @copyright Copyright (c) 2015 Yiister
 * @license https://github.com/yiister/yii2-gentelella/blob/master/LICENSE
 * @link http://gentelella.yiister.ru
 */

namespace app\gentelella\assets;

use yii\web\AssetBundle;

class ThemeAsset extends AssetBundle
{
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset',
       //s 'rmrevin\yii\fontawesome\AssetBundle',
        'app\gentelella\assets\BootstrapProgressbar',
        'app\gentelella\assets\ThemeBuildAsset',
        'app\gentelella\assets\ThemeSrcAsset',
    ];
}
