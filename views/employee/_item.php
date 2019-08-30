<?php
/**
 * Created by PhpStorm.
 * User: Aziz Juraev
 * Date: 30.08.2019
 * Time: 19:06
 *
 * @var \app\models\Employees $model
 *
 */
?>

<div class="col-md-3">
    <div class="col-md-12 employee-item">
        <a href="<?= \yii\helpers\Url::to(['employee/view', 'id' => $model->id]) ?>">
            <img src="<?= $model->photo ?>" class="img-responsive img-thumbnail">
            <h4>
                <?= $model->secondname ?>
                <?= $model->firstname ?>
                <?= $model->lastname ?>
            </h4>
        </a>
    </div>
</div>
