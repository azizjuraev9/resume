<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 14.08.2019
 * Time: 13:21
 */

namespace app\widgets;


use Yii;
use yii\base\Widget;
use yii\bootstrap\Nav;

class MainMenu extends Widget
{

    public function run()
    {

        $items = [];

        if(Yii::$app->user->isGuest)
        {
            $items[] = ['label' => Yii::t('app','Register'), 'url' => ['/user/registration/register']];
            $items[] = ['label' => Yii::t('app','Login'), 'url' => ['/user/security/login']];
        }
        else
        {
            $items[] = [
                'label' => Yii::t('app','Employees'),
                'items' => [
                    ['label' => Yii::t('app','List'), 'url' => ['/employee/index']],
                    ['label' => Yii::t('app','Create'), 'url' => ['/employee/create']],
                ],
            ];
            $items[] = [
                'label' => Yii::t('app','Logout'),
                'url' => ['/user/security/logout'],
                'linkOptions' => [
                    'data' => ['method' => 'post'],
                ],
            ];
            $items[] = ['label' => Yii::t('app','Profile'), 'url' => ['/user/settings/profile']];
        }

        return Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' => $items,
        ]);
    }

}