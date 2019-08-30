<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 29.08.2019
 * Time: 13:35
 */

namespace app\assets;


use yii\web\AssetBundle;

class ResumeAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/resume.css',
    ];
    public $js = [
    ];
    public $depends = [
        AppAsset::class
    ];
}