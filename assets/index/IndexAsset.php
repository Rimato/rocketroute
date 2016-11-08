<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets\index;

use yii\web\AssetBundle;

/**
 * Class AppAsset
 * @package app\assets
 */
class IndexAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
    ];
    public $js = [
        'js/index/mapScripts.js'
    ];
    public $depends = [
        'app\assets\AppAsset'
    ];
}
