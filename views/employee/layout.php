<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 29.08.2019
 * Time: 13:14
 *
 * @var \yii\web\View $this
 * @var string $view
 * @var array $params
 * @var \app\models\Employees $model
 *
 */
$model = $params['model'];

use app\widgets\EmployeeMenu;
use yii\bootstrap\NavBar; ?>

<div class="col-md-3">
        <?php
//        NavBar::begin([
//            'brandLabel' => $model->firstname . ' ' . $model->lastname,
//            'brandUrl' => \yii\helpers\Url::current(),
//        ]);
        echo EmployeeMenu::widget([
            'model' => $model,
            'options' => ['class'=>'nav-pills nav-stacked resume-nav']
        ]);
//        NavBar::end();
        ?>
</div>

<div class="col-md-9">
    <?= $this->render($view,$params); ?>
</div>
