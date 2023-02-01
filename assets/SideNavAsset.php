<?php

/**
 * @copyright Copyright &copy; Kartik Visweswaran, Krajee.com, 2014
 * @package yii2-widgets
 * @subpackage yii2-widget-sidenav
 * @version 1.0.0
 */

namespace app\gentelella;

use app\gentelella\AssetBundle;

/**
 * Asset bundle for SideNav Widget
 *
 * @author Kartik Visweswaran <kartikv2@gmail.com>C:\xampp1\htdocs\unisda\vendor\kartik-v\yii2-krajee-base\src
 * @since 1.0
 */
class SideNavAsset extends AssetBundle
{
    public function init()
    {
        $this->setSourcePath(__DIR__ . '/assets');
        $this->setupAssets('css', ['css/sidenav']);
        $this->setupAssets('js', ['js/sidenav']);
        parent::init();
    }
}
