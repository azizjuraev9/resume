<?php

use app\enums\Nations;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\models\Employees */

$this->title = $model->secondname . ' ' . $model->firstname . ' ' . $model->lastname;
?>
<div class="employees-update">

    <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'image')->fileInput() ?>

        <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'secondname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'birth_date')->widget(DatePicker::class,[
//            'convertFormat' => true,
            'pluginOptions' => [
//                'format' => [
//                    'toDisplay' => 'dd.mm.yyyy',
//                    'toValue' => 'Y-m-d',
//                ],
                'format' => 'dd.mm.yyyy',
                'todayHighlight' => true
            ]
        ]) ?>

        <?= $form->field($model, 'nation')->dropDownList(Nations::getList()) ?>

        <?= $form->field($model, 'phone')->widget(MaskedInput::class,[
            'mask' => '+\9\98 99 999-99-99',
        ]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>
