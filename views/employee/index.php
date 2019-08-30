<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EmployeesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Employees');
?>
<div class="employees-index">

    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <h1>
        <?= Html::encode($this->title) ?>
        <?= Html::a(Yii::t('app', 'Create Employees'), ['create'], ['class' => 'btn btn-success pull-right']) ?>
    </h1>


    <div class="row">
        <?= ListView::widget([
            'dataProvider' => $dataProvider,
            'itemOptions' => ['class' => 'item'],
            'itemView' => '_item',
            'summary' => '',
    //        'itemView' => function ($model, $key, $index, $widget) {
    //            return Html::a(Html::encode($model->id), ['view', 'id' => $model->id]);
    //        },
        ]) ?>
    </div>



</div>
