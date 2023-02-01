<?php
/**
 * @copyright Copyright (c) 2015 Yiister
 * @license https://github.com/yiister/yii2-gentelella/blob/master/LICENSE
 * @link http://gentelella.yiister.ru
 */

namespace app\gentelella\assets;

class Asset extends \yii\web\AssetBundle
{
    
    public $depends = [
        'app\gentelella\assets\ThemeAsset',
        'app\gentelella\assets\ExtensionAsset',
    ];
}
